import Swal from 'sweetalert2'

class Settings {
  static settings = {}

  static async grabSettings() {
    try {
      const response = await fetch('/api/system/settings')
      const data = await response.json()
      if (data.success) {
        Settings.settings = data.settings
        return Settings.settings
      } else {
        throw new Error(data.message || 'Failed to fetch settings')
      }
    } catch (error) {
      console.error('Error fetching settings:', error)
      throw error
    }
  }

  static async initializeSettings() {
    try {
      const fetchedSettings = await Settings.grabSettings()
      console.log('Settings fetched:', fetchedSettings)
      for (const [key, value] of Object.entries(fetchedSettings)) {
        localStorage.setItem(key, JSON.stringify(value))
      }
    } catch (error) {
      console.error('Failed to initialize settings:', error)
      Swal.fire({
        icon: 'error',
        title: 'Failed to initialize session!',
        text: 'It looks like something went really wrong. Please try again later or contact the webmaster.',
      }).then(() => {
        document.body.innerHTML =
          '<h1>We are so sorry but our backend is down at this moment :(</h1>'
      })
    }
  }

  static getSetting(key: string) {
    const item = localStorage.getItem(key)
    return item ? JSON.parse(item) : null
  }
}

export default Settings
