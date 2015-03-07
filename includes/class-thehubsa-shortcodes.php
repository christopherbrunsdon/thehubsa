<?php

//define('SHORTCODE_THEHUBSA_LIST_NPO', 'thehubsa_list_npo');


class TheHubSA_Shortcodes
{
    /**
     * register all shortcodes
     *
     */
    public static function init()
    {
        $shortcodes=array(
            'thehubsa_list_npo' => __CLASS__.'::list_npo',
            'thehubsa_form_signup_npo' => __CLASS__.'::form_signup_npo',
        );

        foreach ($shortcodes as $shortcode=>$function) {
            add_shortcode(apply_filters("{$shortcode}_shortcode_tag", $shortcode), $function);
        }
    }

    /**
     * @param $function
     * @param array $atts
     */
    public static function shortcode_wrapper($function, $atts=array())
    {
        ob_start();
        // before css
        call_user_func($function, $atts);
        // after css
        return ob_get_clean();
    }

    /**
     * @return string
     */
    public static function list_npo()
    {
        return self::shortcode_wrapper(array(new controller_npo(),'render'));
    }

    /**
     * @return string
     */
    public static function form_signup_npo()
    {
        error_log(__CLASS__.'::'.__METHOD__);
        return self::shortcode_wrapper(array(new form_npo(), 'shortcode'));
    }
}