<?php
/**
 Admin Page Framework v3.7.2b03 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
abstract class AdminPageFramework_Factory_Controller extends AdminPageFramework_Factory_View {
    public function start() {
    }
    public function setUp() {
    }
    public function setMessage($sKey, $sMessage) {
        $this->oMsg->set($sKey, $sMessage);
    }
    public function getMessage($sKey = '') {
        return $this->oMsg->get($sKey);
    }
    public function enqueueStyles($aSRCs, $_vArg2 = null) {
    }
    public function enqueueStyle($sSRC, $_vArg2 = null) {
    }
    public function enqueueScripts($aSRCs, $_vArg2 = null) {
    }
    public function enqueueScript($sSRC, $_vArg2 = null) {
    }
    public function addHelpText($sHTMLContent, $sHTMLSidebarContent = "") {
        if (method_exists($this->oHelpPane, '_addHelpText')) {
            $this->oHelpPane->_addHelpText($sHTMLContent, $sHTMLSidebarContent);
        }
    }
    public function addSettingSections() {
        foreach (func_get_args() as $_asSectionset) {
            $this->addSettingSection($_asSectionset);
        }
        $this->_sTargetSectionTabSlug = null;
    }
    public function addSettingSection($aSectionset) {
        if (!is_array($aSectionset)) {
            return;
        }
        $this->_sTargetSectionTabSlug = $this->oUtil->getElement($aSectionset, 'section_tab_slug', $this->_sTargetSectionTabSlug);
        $aSectionset['section_tab_slug'] = $this->oUtil->getAOrB($this->_sTargetSectionTabSlug, $this->_sTargetSectionTabSlug, null);
        $this->oForm->addSection($aSectionset);
    }
    public function addSettingFields() {
        foreach (func_get_args() as $_aFieldset) {
            $this->addSettingField($_aFieldset);
        }
    }
    public function addSettingField($asFieldset) {
        if (method_exists($this->oForm, 'addField')) {
            $this->oForm->addField($asFieldset);
        }
    }
    public function setFieldErrors($aErrors) {
        $this->oForm->setFieldErrors($aErrors);
    }
    public function hasFieldError() {
        return $this->oForm->hasFieldError();
    }
    public function setSettingNotice($sMessage, $sType = 'error', $asAttributes = array(), $bOverride = true) {
        $this->oForm->setSubmitNotice($sMessage, $sType, $asAttributes, $bOverride);
    }
    public function hasSettingNotice($sType = '') {
        return $this->oForm->hasSubmitNotice($sType);
    }
}