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
            HtmlEditorField::create('CookiePolicyText'),
            TextareaField::create('CookiePolicyCSS'),
            TextField::create('CookiePolicyButtonCaption')
        ));
    }

}