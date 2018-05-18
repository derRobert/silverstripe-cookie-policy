<?php

class CookiePolicySiteConfigExtension extends DataExtension
{

    private static $db = array(
        'CookiePolicyEnabled'       => 'Boolean(0)',
        'CookiePolicyText'          => 'HTMLText',
        'CookiePolicyCSS'           => 'Text',
        'CookiePolicyButtonCaption' => 'Varchar(64)',
    );

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.CookiePolicy', array(
            CheckboxField::create('CookiePolicyEnabled'),
            CheckboxField::create('CookiePolicyLoadDefaults', 'Beim Speichern Vorgaben laden')
                ->setValue(0)
                ->setDescription('Alle Angaben werden überschieben. Nach dem Speichern müssen Sie 1x diese Seite neu laden, damit Sie die Änderungen sehen')
        ,
            HtmlEditorField::create('CookiePolicyText'),
            TextareaField::create('CookiePolicyCSS'),
            TextField::create('CookiePolicyButtonCaption')
        ));
    }

    public function onBeforeWrite()
    {
        if (!Director::is_cli() && $cont = Controller::curr()) {
            if ($req = $cont->getRequest()) {
                if ($req->requestVar('CookiePolicyLoadDefaults')) {
                    $d = $this->getDefaults();
                    $this->owner->CookiePolicyText = $d['CookiePolicyText'];
                    $this->owner->CookiePolicyCSS = $d['CookiePolicyCSS'];
                    $this->owner->CookiePolicyButtonCaption = $d['CookiePolicyButtonCaption'];
                    $this->owner->CookiePolicyLoadDefaults = false;
                }
            }
        }
    }


    private function getDefaults()
    {
        $text = <<<HTML
<p>Wir verwenden Cookies, um unsere Dienste zu erbringen. Durch die Nutzung unserer Internetseite stimmen Sie der Nutzung von Cookies gemäß unserer Datenschutz-Richtlinie zu.</p>
HTML;
        $css = <<<CSS
#cookie-policy-banner {
	position: fixed;
	bottom: 0px;
	left: 0px;
	width: 100%;
	height: 4em;
	overflow: hidden;
	background: #444;
	color: #ddd;
}
#cookie-policy-banner > div {
	margin: 1em;
	padding-right: 120px;
	position: relative;
}

#cookie-policy-banner-accept {
	position: absolute;
	right: 1em;
	top: 0;
	padding: .3em .75em;
	font-weight: bold;
}
CSS;


        return array(
            'CookiePolicyText'          => $text,
            'CookiePolicyCSS'           => $css,
            'CookiePolicyButtonCaption' => 'Verstanden',
        );
    }

}