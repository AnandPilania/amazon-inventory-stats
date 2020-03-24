<spark-profile :user="user" inline-template>
    <div>
        <!-- Update Profile Photo -->
        @include('spark::frontend.settings.profile.update-profile-photo')

        <!-- Update Contact Information -->
        @include('spark::frontend.settings.profile.update-contact-information')
    </div>
</spark-profile>
