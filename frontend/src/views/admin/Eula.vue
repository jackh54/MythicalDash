<template>
    <LayoutDashboard>
        <div class="max-w-4xl mx-auto space-y-6">
            <h1 class="text-3xl font-bold text-gray-100">End User License Agreement</h1>

            <div class="bg-gray-800/50 rounded-lg p-6 border border-gray-700/50">
                <div class="mb-6">
                    <p class="text-gray-300 mb-4">
                        Please read this End User License Agreement carefully before using MythicalClient.
                    </p>
                    <div class="h-96 overflow-y-auto bg-gray-900/50 rounded-lg p-4 border border-gray-700/50">
                        <div class="prose prose-invert" v-html="eulaContent"></div>
                    </div>
                </div>

                <div class="flex items-center mb-6">
                    <input type="checkbox" id="agree" v-model="agreed"
                        class="w-4 h-4 text-purple-600 bg-gray-700 border-gray-600 rounded focus:ring-purple-500 focus:ring-2">
                    <label for="agree" class="ml-2 text-sm text-gray-300">
                        I have read and agree to the End User License Agreement
                    </label>
                </div>

                <div class="flex gap-4">
                    <button @click="acceptEula" :disabled="!agreed"
                        class="px-6 py-2 bg-purple-600 text-white rounded-lg font-medium transition-colors"
                        :class="{ 'opacity-50 cursor-not-allowed': !agreed, 'hover:bg-purple-700': agreed }">
                        Accept
                    </button>
                    <button @click="denyEula"
                        class="px-6 py-2 bg-gray-700 text-gray-300 rounded-lg font-medium hover:bg-gray-600 transition-colors">
                        Deny
                    </button>
                </div>
            </div>

            <Modal v-if="showModal" @close="closeModal">
                <template #header>
                    <h3 class="text-lg font-medium text-gray-100">{{ modalTitle }}</h3>
                </template>
                <template #body>
                    <p class="text-gray-300">{{ modalMessage }}</p>
                </template>
                <template #footer>
                    <button @click="closeModal"
                        class="px-4 py-2 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 transition-colors">
                        Close
                    </button>
                </template>
            </Modal>
        </div>
    </LayoutDashboard>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import LayoutDashboard from '@/components/LayoutDashboard.vue'
import Modal from '@/components/ui/Modal.vue'

const router = useRouter()
const agreed = ref(false)
const showModal = ref(false)
const modalTitle = ref('')
const modalMessage = ref('')

// Replace this with your actual EULA content
const eulaContent = `
    <h2>MythicalSystems End User License Agreement (EULA)</h2>
    <p>This End User License Agreement ("EULA") constitutes a binding legal agreement between you ("the User") and MythicalSystems Ltd. or its applicable local affiliates (collectively referred to as "MythicalSystems").</p>
    <p>By accessing or using any MythicalSystems services, software, or content ("Services"), you acknowledge that you have read, understood, and agree to be bound by the terms and conditions of this EULA and the MythicalSystems Services Agreement. Please read these terms carefully.</p>
    
    <h3>1. Scope of Agreement</h3>
    <p>This EULA, together with the MythicalSystems Services Agreement, governs your use of all MythicalSystems websites, software, products, and services, including any updates, patches, or modifications that may be provided in the future. By accepting these terms, you also agree to abide by any supplemental policies, including but not limited to our community standards and Software Usage Guidelines, which may be updated from time to time.</p>
    
    <h3>2. Ownership and Intellectual Property</h3>
    <p>While MythicalSystems values your creative contributions, we retain exclusive ownership of all proprietary software, code, content, and intellectual property developed by us. You are granted a non-exclusive, non-transferable, and revocable license to use our Services in accordance with this EULA.</p>
    <p>Your original works, including plugins, themes, and modifications, remain your property, provided they do not incorporate a substantial portion of MythicalSystems' code or intellectual property. MythicalSystems does not claim ownership of your original creations, but we reserve the right to determine whether content contains infringing elements.</p>
    
    <h4>2.1 Restrictions on Distribution</h4>
    <p>You are expressly prohibited from distributing, sublicensing, or commercially exploiting any MythicalSystems software, content, or services without prior written consent from MythicalSystems. This includes but is not limited to sharing, copying, or reselling our products, software, and any related modifications or derivatives.</p>
    
    <h3>3. Account Usage and Terms</h3>
    <p>A MythicalSystems account is required to access certain features, purchase services, or interact with MythicalSystems platforms. You are responsible for maintaining the security and confidentiality of your account credentials. If you acquire any MythicalSystems product via a third-party platform (e.g., Spigot or BuiltByBit), the respective terms of that platform will also apply in conjunction with this EULA.</p>
    <p>MythicalSystems reserves the right to suspend or terminate accounts that are in breach of this EULA or related agreements.</p>
    
    <h3>4. Permitted Modifications (Plugins and Themes)</h3>
    <p>We encourage the development of plugins, themes, and other creative contributions, subject to the following conditions:</p>
    <ul>
        <li>Plugins and Themes must not contain significant portions of MythicalSystems' proprietary code.</li>
        <li>Originality: Any plugin or theme created by you must be your own original work.</li>
        <li>Commercial Restrictions: You are not permitted to sell plugins or themes for excessive or inflated prices. Nulled or unauthorized versions of plugins and themes are strictly forbidden.</li>
        <li>Compatibility: MythicalSystems assumes no responsibility for ensuring that your plugins or themes will be compatible with future updates or modifications to our Services.</li>
    </ul>
    <p>We reserve the right to review, approve, or revoke permissions for plugins and themes at any time.</p>
    
    <h3>5. Content Ownership</h3>
    <p>Your content remains your own, including any text, images, or code that you develop independently. However, MythicalSystems retains ownership of any substantial derivative works or content that incorporates or mimics our proprietary software, designs, or materials.</p>
    <p>For example:</p>
    <ul>
        <li>If your plugin consists of less than 100 lines of code based on MythicalSystems' core code, we maintain ownership of that derivative work.</li>
        <li>If you create a standalone plugin with significant new functionality (e.g., Discord integration) containing over 400 lines of code, you retain ownership of that original creation.</li>
    </ul>
    
    <h3>6. Community Standards and Online Safety</h3>
    <p>MythicalSystems is committed to fostering a safe, respectful, and inclusive community. As a user of our Services, you agree to uphold these values and avoid engaging in any activities that promote hate speech, harassment, violence, or illegal conduct. Fraudulent behavior, such as using deceit or misrepresentation for personal gain, is strictly prohibited.</p>
    <p>Interactions with others through our Services, third-party platforms, or community forums are at your own risk. We advise caution when sharing personal information or communicating with others, as MythicalSystems cannot guarantee the authenticity or integrity of third-party participants.</p>
    <p>We reserve the right to suspend or permanently ban any user who violates these standards or any other terms of this EULA.</p>
    
    <h3>7. Legal Compliance and Amendments</h3>
    <p>This EULA and any supplemental policies may be updated or amended by MythicalSystems at any time, without prior notice. It is your responsibility to review these terms periodically to ensure compliance. Continued use of MythicalSystems' Services after changes to the EULA signifies your acceptance of the revised terms.</p>
    
    <h3>8. Limitation of Liability</h3>
    <p>To the fullest extent permitted by law, MythicalSystems shall not be held liable for any indirect, incidental, or consequential damages resulting from the use or inability to use our Services, including but not limited to lost profits, data loss, or compatibility issues arising from third-party plugins or updates.</p>
    
    <h3>9. Termination</h3>
    <p>Failure to comply with this EULA may result in immediate termination of your license and access to MythicalSystems' Services. MythicalSystems reserves the right to terminate or suspend access to any account, service, or content without notice if the User violates any provision of this EULA.</p>
    
    <h3>10. Governing Law</h3>
    <p>This EULA shall be governed by and construed in accordance with the laws of the jurisdiction in which MythicalSystems Ltd. is established, without regard to conflicts of law principles. Any disputes arising from this EULA shall be resolved in the courts of that jurisdiction.</p>
    
    <h3>11. Contact Information</h3>
    <p>For any questions regarding this EULA or MythicalSystems' Services, please contact us at <a href="mailto:abuse@mythicalsystems.xyz">abuse@mythicalsystems.xyz</a>.</p>
`
  

const acceptEula = () => {
    if (agreed.value) {
        modalTitle.value = 'EULA Accepted'
        modalMessage.value = 'Thank you for accepting the EULA. You can now proceed to use MythicalClient.'
        showModal.value = true
    }
}

const denyEula = () => {
    modalTitle.value = 'EULA Denied'
    modalMessage.value = 'You have chosen not to accept the EULA. Please uninstall MythicalClient.'
    showModal.value = true
}

const closeModal = () => {
    showModal.value = false
    if (modalTitle.value === 'EULA Accepted') {
        router.push('/admin/dashboard')
    } else {
        router.push('/admin/eula')
    }
}
</script>

<style>
.prose h2 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
    margin-top: 1.5rem;
    color: #f3f4f6;
}

.prose p {
    margin-bottom: 1rem;
    color: #d1d5db;
}

.prose ul {
    list-style-type: disc;
    padding-left: 1.25rem;
    margin-bottom: 1rem;
    color: #d1d5db;
}

.prose li {
    margin-bottom: 0.5rem;
}
</style>