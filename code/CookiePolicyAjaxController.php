<?php

/**
 * Created by PhpStorm.
 * User: robert
 * Date: 26.08.18
 * Time: 16:05
 */
class CookiePolicyAjaxController extends Controller
{


    public function index(SS_HTTPRequest $request)
    {
        if (!Director::is_ajax()) {
            return $this->httpError(403, 'ajax only ...');
        }
        $cfg = SiteConfig::current_site_config();
        if (!$cfg->CookiePolicyEnabled) {
            return;
        }
        $html = $cfg->renderWith('CookiePolicyBanner');
        $html = sprintf("<style>%s</style>", $cfg->CookiePolicyCSS) . $html;
        return $html;

    }

}