<?php

class SabrePost extends TimberPost
{
    public function types($fieldId)
    {
        $field = types_get_field($fieldId);
        $single = array_key_exists('repetitive', $field['data']) && $field['data']['repetitive'] == 1 ? false : true;
        return get_post_meta($this->ID, 'wpcf-' . $fieldId, $single);
    }
}

