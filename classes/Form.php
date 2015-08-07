<?php

class Form extends Input
{

    /**
     * Creates a slug STATIC method
     *
     * converts a string into a single string
     *
     * @example convert this string "big brown fox" into this string "big_brown_fox"
     *
     * @param  string $slug the single string
     * @return string       returns the $slug variable
     */
    static function createSlug($slug){
        // remove anything that isn't letters, numnber, spaces, hypens
        // remove spaces and duplicat hypens
        // trim left and right, removing any left overs hypens
        // to use: echo createSlug('---This ----- - - in an article          title ^&**%^');
        // will render "this-in-an-article-title"

        $lettersNumbersSpacesHypens = '/[^\-\s\pN\pL]+/u';
        $spacesDuplicatHypens = '/[\-\s]+/';

        $slug = preg_replace($lettersNumbersSpacesHypens, '', mb_strtolower($slug, 'UTF-8'));
        $slug = preg_replace($spacesDuplicatHypens, '-', $slug);
        $slug = trim($slug, '-');

        return $slug;
    }
}




 ?>