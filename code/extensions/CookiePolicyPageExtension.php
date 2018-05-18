<?php

class CookiePolicyPageExtension extends Extension {

    private static $cookie_policy_cookie_name = 'CookiePolicyAccepted' ;


    public function CookiePolicyBanner() {
        $cfg = SiteConfig::current_site_config();
        if( ! $cfg->CookiePolicyEnabled ) {
            return;
        }
        if( !Cookie::get($this->owner->config()->cookie_policy_cookie_name) ) {

            Requirements::customCSS($cfg->CookiePolicyCSS);
            Requirements::javascript( COOKIE_POLICY_MODULE_DIR.'/javascript/cookie-policy.js');

            return $cfg->renderWith('CookiePolicyBanner');
        }
    }

}