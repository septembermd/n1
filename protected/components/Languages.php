<?php

class Languages extends CApplicationComponent
{
    /**
     * @var boolean enable language component.
     */
    public $useLanguage = false;
    /**
     * @var boolean auto detect language if not set.
     */
    public $autoDetect = false;
    /**
     * @var array allowed languages.
     */
    public $languages = ['en', 'ro', 'ru'];
    /**
     * @var array languages titles for link.
     */
    public $languagesTitles = ['en' => 'English', 'ro' => 'Româna', 'ru' => 'Russian'];
    /**
     * @var string default language.
     */
    public $defaultLanguage = 'en';
    /**
     * @var string hidden input id.
     */
    public $id = 'siteLang';

    /**
     * @return void
     */
    public function init()
    {
        if ($this->useLanguage) {
            $this->initLanguage();
        }
    }

    /**
     * @return void
     */
    private function initLanguage()
    {
        $language = Yii::app()->session->itemAt('language');

        if ($language === null) {
            if ($this->autoDetect) {
                $language = Yii::app()->getRequest()->getPreferredLanguage();
            } elseif ($this->defaultLanguage) {
                $language = $this->defaultLanguage;
            }
        }

        $languageId = array_search($language, $this->languages);
        $language = $this->languages[$languageId === false ? 0 : $languageId];
        Yii::app()->session['language'] = $language;
        Yii::app()->setLanguage($language);
    }


}