<?php

class CookiePolicyPageExtension extends Extension {

    private static $cookie_policy_cookie_name = 'CookiePolicyAccepted' ;


    public function CookiePolicyBanner() {
        $c = Cookie::get_all();
        if( !Cookie::get($this->owner->config()->cookie_policy_cookie_name) ) {
            $cfg = SiteConfig::current_site_config();

            Requirements::customCSS($cfg->CookiePolicyCSS);
            Requirements::javascript( COOKIE_POLICY_MODULE_DIR.'/javascript/cookie-policy.js');

            return $cfg->renderWith('CookiePolicyBanner');
        }
    }

}