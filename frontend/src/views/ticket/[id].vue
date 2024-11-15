<template>
    <LayoutDashboard>
        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-100">Ticket #{{ ticket.id }}</h1>
                <button @click="router.push('/ticket')"
                    class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg text-sm font-medium transition-colors">
                    Back to Tickets
                </button>
            </div>

            <!-- Ticket Details -->
            <CardComponent>
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-xl font-medium text-gray-100">{{ ticket.subject }}</h2>
                        <p class="text-sm text-gray-400">Opened on {{ ticket.createdAt }}</p>
                    </div>
                    <span :class="{
                        'bg-green-500/20 text-green-400': ticket.status === 'Open',
                        'bg-yellow-500/20 text-yellow-400': ticket.status === 'In Progress',
                        'bg-blue-500/20 text-blue-400': ticket.status === 'Awaiting Response',
                        'bg-gray-500/20 text-gray-400': ticket.status === 'Closed'
                    }" class="px-3 py-1 rounded-full text-sm font-medium">
                        {{ ticket.status }}
                    </span>
                </div>
                <p class="text-gray-300">{{ ticket.description }}</p>
            </CardComponent>
            <!-- Chat Interface -->
            <CardComponent>
                <div class="p-4 h-96 overflow-y-auto space-y-4" ref="chatContainer">
                    <div v-for="message in ticket.messages" :key="message.id" class="flex"
                        :class="{ 'justify-end': message.isClient }">
                        <div class="max-w-3/4 rounded-lg p-3" :class="{
                            'bg-purple-500/20 text-purple-100': message.isClient,
                            'bg-gray-700/50 text-gray-300': !message.isClient
                        }">
                            <p class="text-sm">{{ message.content }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ message.timestamp }}</p>
                        </div>
                    </div>
                </div>
                <div class="border-t border-gray-700 p-4">
                    <form @submit.prevent="sendMessage" class="flex space-x-2">
                        <input type="text" v-model="newMessage" placeholder="Type your message..."
                            class="flex-grow bg-gray-700/50 border border-gray-600 rounded-lg px-4 py-2 text-sm text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500" />
                        <button type="submit"
                            class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-lg text-sm font-medium transition-colors">
                            Send
                        </button>
                    </form>
                </div>
            </CardComponent>
        </div>
    </LayoutDashboard>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import LayoutDashboard from '../../components/LayoutDashboard.vue'
import TextInput from '../../components/ui/TextForms/TextInput.vue';
import CardComponent from '../../components/ui/Card/CardComponent.vue';

const router = useRouter()
const route = useRoute()

const ticket = ref({
    id: route.params.id,
    subject: 'Cannot access my account',
    status: 'Open',
    createdAt: '2023-05-10 14:30',
    description: 'I am unable to log into my account. It says my password is incorrect, but I am sure I am using the right password.',
    messages: [
        { id: 1, content: 'Hello, I cannot access my account. Can you help?', isClient: true, timestamp: '2023-05-10 14:30' },
        { id: 2, content: 'Hi there! I\'d be happy to help. Can you please provide me with your username or email address associated with the account?', isClient: false, timestamp: '2023-05-10 14:35' },
        { id: 3, content: 'My email is john@example.com', isClient: true, timestamp: '2023-05-10 14:37' },
        { id: 4, content: 'Thank you for providing that information. I\'ve checked your account, and it seems there were multiple failed login attempts. For security reasons, your account has been temporarily locked. I\'ve sent a password reset link to your email. Please check your inbox and follow the instructions to regain access to your account.', isClient: false, timestamp: '2023-05-10 14:42' },
    ]
})

const newMessage = ref('')
const chatContainer = ref(null)

const sendMessage = () => {
    if (newMessage.value.trim() === '') return

    ticket.value.messages.push({
        id: ticket.value.messages.length + 1,
        content: newMessage.value,
        isClient: true,
        timestamp: new Date().toISOString().split('T')[0] + ' ' + new Date().toTimeString().split(' ')[0].slice(0, 5)
    })

    newMessage.value = ''

    // Scroll to bottom of chat
    nextTick(() => {
        if (chatContainer.value) {
            chatContainer.value.scrollTop = chatContainer.value.scrollHeight
        }
    })
}

onMounted(() => {
    // Scroll to bottom of chat on initial load
    if (chatContainer.value) {
        chatContainer.value.scrollTop = chatContainer.value.scrollHeight
    }
})
</script>