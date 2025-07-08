<template>
    <Head :title="task.title" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="px-8 py-6 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="p-3 bg-purple-100 rounded-xl">
                                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900">{{ task.title }}</h1>
                                    <p class="text-sm text-gray-600 mt-1">Détails de la tâche</p>
                                </div>
                            </div>
                            <Link :href="route('tasks.index')"
                                  class="text-gray-600 hover:text-gray-800 flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-white/50 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span>Retour</span>
                            </Link>
                        </div>
                    </div>
                    <div class="p-8 text-gray-900">
                        <!-- Messages de succès et d'erreur -->
                        <div v-if="$page.props.flash?.success" class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg">
                            <div class="flex">
                                <svg class="w-5 h-5 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-green-700 font-medium">{{ $page.props.flash.success }}</p>
                            </div>
                        </div>
                        <div v-if="$page.props.flash?.error" class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                            <div class="flex">
                                <svg class="w-5 h-5 text-red-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-red-700 font-medium">{{ $page.props.flash.error }}</p>
                            </div>
                        </div>

                        <div class="grid lg:grid-cols-3 gap-8">
                            <div class="lg:col-span-2 space-y-6">
                                <!-- Description -->
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <div class="flex items-center space-x-2 mb-4">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-gray-900">Description</h3>
                                    </div>
                                    <div v-if="task.description" class="prose prose-gray max-w-none">
                                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ task.description }}</p>
                                    </div>
                                    <div v-else class="flex items-center justify-center py-8">
                                        <div class="text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">Aucune description fournie</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <!-- Informations -->
                                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                                    <div class="flex items-center space-x-2 mb-6">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-gray-900">Informations</h3>
                                    </div>

                                    <div class="space-y-4">
                                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Statut</span>
                                            <span :class="statusClass(task.status)" class="inline-flex px-3 py-1 text-xs font-semibold rounded-full">
                                                {{ statusText(task.status) }}
                                            </span>
                                        </div>

                                        <div v-if="task.date" class="flex items-center justify-between py-3 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Date d'échéance</span>
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-900">{{ formatDate(task.date) }}</span>
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between py-3 border-b border-gray-100">
                                            <span class="text-sm font-medium text-gray-600">Créé le</span>
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-900">{{ formatDateTime(task.created_at) }}</span>
                                            </div>
                                        </div>

                                        <div v-if="task.updated_at !== task.created_at" class="flex items-center justify-between py-3">
                                            <span class="text-sm font-medium text-gray-600">Modifié le</span>
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                <span class="text-sm font-medium text-gray-900">{{ formatDateTime(task.updated_at) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                                    <div class="flex items-center space-x-2 mb-4">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-gray-900">Actions</h3>
                                    </div>
                                    <div class="space-y-3">
                                        <Link :href="route('tasks.edit', task.id)"
                                              class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <span>Modifier la tâche</span>
                                        </Link>
                                        <button @click="deleteTask"
                                                class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center space-x-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            <span>Supprimer la tâche</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
// Importation des composants et utilitaires nécessaires depuis Inertia et le layout authentifié
import { Head, Link, router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

// Définition des props avec la tâche passée en paramètre
const props = defineProps({
    task: Object
})

// Fonction qui retourne les classes CSS pour le style du statut
// Chaque statut a sa propre couleur de fond et de texte
const statusClass = (status) => {
    const classes = {
        'todo': 'bg-gray-200 text-gray-800',
        'in_progress': 'bg-yellow-200 text-yellow-800',
        'complete': 'bg-green-200 text-green-800'
    }
    return classes[status] || 'bg-gray-200 text-gray-800'
}

// Fonction qui traduit les statuts en français pour l'affichage
const statusText = (status) => {
    const texts = {
        'todo': 'À faire',
        'in_progress': 'En cours',
        'complete': 'Terminé'
    }
    return texts[status] || status
}

// Fonction qui formate une date au format français (JJ/MM/AAAA)
const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR')
}

// Fonction qui formate une date et heure au format français (JJ/MM/AAAA HH:MM:SS)
const formatDateTime = (datetime) => {
    return new Date(datetime).toLocaleString('fr-FR')
}

// Fonction de suppression de la tâche avec confirmation
// Utilise le router Inertia pour envoyer une requête DELETE
const deleteTask = () => {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) {
        router.delete(route('tasks.destroy', props.task.id))
    }
}
</script>
