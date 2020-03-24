<spark-security :user="user" inline-template>
	<div>
	    <!-- Update Password -->
	    @include('spark::frontend.settings.security.update-password')

	    <!-- Two-Factor Authentication -->
	    @if (Spark::usesTwoFactorAuth())
	    	<div v-if="user && ! user.uses_two_factor_auth">
	    		@include('spark::frontend.settings.security.enable-two-factor-auth')
	    	</div>

	    	<div v-if="user && user.uses_two_factor_auth">
	    		@include('spark::frontend.settings.security.disable-two-factor-auth')
	    	</div>

			<!-- Two-Factor Reset Code Modal -->
	    	@include('spark::frontend.settings.security.modals.two-factor-reset-code')
	    @endif
    </div>
</spark-security>
