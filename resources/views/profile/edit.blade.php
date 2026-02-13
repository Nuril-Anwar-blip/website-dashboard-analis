<x-app-layout>
    <div class="min-h-screen bg-slate-50">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-bold text-3xl text-slate-900">
                    Profile Settings
                </h2>
            </div>
        </header>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <!-- Update Profile Information -->
                <div class="p-4 sm:p-8 bg-white shadow-sm rounded-xl border border-slate-200">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- Update Password -->
                <div class="p-4 sm:p-8 bg-white shadow-sm rounded-xl border border-slate-200">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div class="p-4 sm:p-8 bg-white shadow-sm rounded-xl border border-slate-200">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
