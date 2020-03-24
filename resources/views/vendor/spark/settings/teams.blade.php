<spark-teams :user="user" :teams="teams" inline-template>
    <div>
        <!-- Create Team -->
        @if (Spark::createsAdditionalTeams())
            @include('spark::frontend.settings.teams.create-team')
        @endif

        <!-- Pending Invitations -->
        @include('spark::frontend.settings.teams.pending-invitations')

        <!-- Current Teams -->
        <div v-if="user && teams.length > 0">
            @include('spark::frontend.settings.teams.current-teams')
        </div>
    </div>
</spark-teams>
