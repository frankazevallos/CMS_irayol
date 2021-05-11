<div class="social-auth-links mb-3">
    <p class="text-center">- {{__('global.or')}} -</p>
    <a href="{{ route('social.oauth', 'facebook') }}" class="btn btn-primary btn-block">
        <i class="fab fa-facebook mr-2"></i> {{__('global.sign_in_using')}} Facebook
    </a>
    <a href="{{ route('social.oauth', 'twitter') }}" class="btn btn-info btn-block">
        <i class="fab fa-twitter mr-2"></i> {{__('global.sign_in_using')}} Twitter
    </a>
    <a href="{{ route('social.oauth', 'google') }}" class="btn btn-danger btn-block">
        <i class="fab fa-google-plus mr-2"></i> {{__('global.sign_in_using')}} Google+
    </a>
    <a href="{{ route('social.oauth', 'github') }}" class="btn btn-default btn-block">
        <i class="fab fa-github mr-2"></i> {{__('global.sign_in_using')}} Github
    </a>
</div>