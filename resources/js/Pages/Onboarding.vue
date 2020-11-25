<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tell us about your home
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <jet-form-section @submitted="addHome">
            <template #title>
                Add a Home
            </template>

            <template #description>
                Add a home to start tracking.
            </template>

            <template #form>
                <!-- Home Name -->
                <div class="col-span-6 sm:col-span-4">
                    <jet-label for="nickname" value="Home Nickname" />
                    <jet-input id="nickname" type="text" class="mt-1 block w-full" v-model="form.nickname" autocomplete="nickname" />
                    <jet-input-error :message="form.error('nickname')" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">TODO: Optional address form here.</div>

            </template>

            <template #actions>
                <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                    Saved.
                </jet-action-message>

                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </jet-button>
            </template>
        </jet-form-section>
                </div>
            </div>
        </div>


    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            AppLayout,
            Welcome,
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },
        props: [],

        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'PUT',
                    nickname: "Zach's house",
                }, {
                    bag: 'updateProfileInformation',
                    resetOnSuccess: false,
                }),
            }
        },

        methods: {
            addHome() {
                this.form.post(route('user-profile-information.update'), {
                    preserveScroll: true
                });
            },
        },
    }
</script>
