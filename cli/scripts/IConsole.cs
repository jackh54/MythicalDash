using YamlDotNet.RepresentationModel;
using YamlDotNet.Serialization;
using System.IO;
using System;
using MySqlConnector;

namespace MythicalDash
{
    public class IConsole
    {
        FileManager fm = new FileManager();

        public void showalllogs() {
            if (fm.ConfigExists() == true)
            {
                string filePath = "/var/www/mythicaldash/config.yml";
                string yamlContent = File.ReadAllText(filePath);

                var deserializer = new DeserializerBuilder().Build();
                var yamlObject = deserializer.Deserialize(new StringReader(yamlContent));
#pragma warning disable
                var databaseSettings = (yamlObject as dynamic)["database"];
#pragma warning restore
                string dbHost = databaseSettings["host"];
                string dbPort = databaseSettings["port"];
                string dbUsername = databaseSettings["username"];
                string dbPassword = databaseSettings["password"];
                string dbName = databaseSettings["database"];
                string connectionString = $"Server={dbHost};Port={dbPort};User ID={dbUsername};Password={dbPassword};Database={dbName}";

                using (var connection = new MySqlConnection(connectionString))
                {
                    connection.Open();
                    Program.logger.Log(LogType.Info, "Connected to MySQL, saving database configuration to config.");
                    Program.logger.Log(LogType.Info, "Showing all logs");
                    Program.logger.Log(LogType.Info, "| ID | Log Title | Log Message |");
                    string query = "SELECT * FROM mythicaldash_logs LIMIT 35";
                    using (var command = new MySqlCommand(query, connection))
                    {
                        using (var reader = command.ExecuteReader())
                        {
                            while (reader.Read())
                            {
                                Program.logger.Log(LogType.Info, $"[{reader["id"]}]: {reader["title"]} - {reader["text"]}");
                            }
                        }
                    }
                    Program.logger.Log(LogType.Info, "|---------------------------------|");

                    connection.Close();
                    Environment.Exit(0x0);
                }
            }
            else
            {
                Program.logger.Log(LogType.Error, "It looks like the config file does not exist!");
            }
        }

        public void disable()
        {
            if (fm.ConfigExists() == true)
            {
                string filePath = "/var/www/mythicaldash/config.yml";
                var yaml = new YamlStream();

                using (var reader = new StreamReader(filePath))
                {
                    yaml.Load(reader);
                }

                var mapping = (YamlMappingNode)yaml.Documents[0].RootNode;
                var appSection = (YamlMappingNode)mapping["app"];

                appSection.Children[new YamlScalarNode("disable_console")] = new YamlScalarNode("true");

                using (var writer = new StreamWriter(filePath))
                {
                    yaml.Save(writer, false);
                }
                Program.RemoveTrailingDots();

                Program.logger.Log(LogType.Info, "We updated the settings");
            }
            else
            {
                Program.logger.Log(LogType.Error, "It looks like the config file does not exist!");
            }
        }
        public void enable()
        {
            if (fm.ConfigExists() == true)
            {
                string filePath = "/var/www/mythicaldash/config.yml";
                var yaml = new YamlStream();

                using (var reader = new StreamReader(filePath))
                {
                    yaml.Load(reader);
                }

                var mapping = (YamlMappingNode)yaml.Documents[0].RootNode;
                var appSection = (YamlMappingNode)mapping["app"];

                appSection.Children[new YamlScalarNode("disable_console")] = new YamlScalarNode("false");

                using (var writer = new StreamWriter(filePath))
                {
                    yaml.Save(writer, false);
                }
                Program.RemoveTrailingDots();

                Program.logger.Log(LogType.Info, "We updated the settings");
            }
            else
            {
                Program.logger.Log(LogType.Error, "It looks like the config file does not exist!");
            }
        }
    }
}