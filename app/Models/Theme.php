<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    ///////////////////////////MODAL STYLES////////////////////////////////
    //MODAL BACKGROUND COLORS
    public const BRIGHT_MODAL_BACKGROUND_COLOR = 'bg-gray-100';
    public const DARK_MODAL_BACKGROUND_COLOR = 'dark:bg-dark-eval-1';

    //MODAL HEADER
    public const BRIGHT_MODAL_HEADER_COLOR = 'text-gray-600';
    public const DARK_MODAL_HEADER_COLOR = 'dark:text-gray-100';

    //MODAL SUBTEXT
    public const DARK_MODAL_SUBTEXT_COLOR = 'dark:text-gray-400';
    public const BRIGHT_MODAL_SUBTEXT_COLOR = 'text-gray-400';

    //MODAL BORDER
    public const MODAL_BORDER = 'border';
    public const DARK_MODAL_BORDER_COLOR = 'dark:border-neutral-700';
    public const BRIGHT_MODAL_BORDER_COLOR = 'border-neutral-700';

    //MODAL CANCEL BUTTON
    public const BRIGHT_MODAL_CANCEL_BUTTON_COLOR = 'bg-neutral-600 ';
    public const BRIGHT_MODAL_CANCEL_HOVER_BUTTON_COLOR = 'bg-neutral-500 ';

    public const DARK_MODAL_CANCEL_BUTTON_COLOR = 'dark:bg-gray-600';
    public const DARK_MODAL_CANCEL_HOVER_BUTTON_COLOR = 'dark:bg-gray-500';
    //////////////////////////////////////////////////////////////////////////



    ///////////////////////////BUTTON STYLES////////////////////////////////
    //EDIT BUTTON
    public const BRIGHT_EDIT_BUTTON_COLOR = 'bg-neutral-600';
    public const BRIGHT_HOVER_EDIT_BUTTON_COLOR = 'bg-neutral-500';

    public const DARK_EDIT_BUTTON_COLOR = 'dark:bg-gray-700';
    public const DARK_HOVER_EDIT_BUTTON_COLOR = 'dark:bg-gray-600';

    //DELETE BUTTON
    public const BRIGHT_DELETE_BUTTON_COLOR = 'bg-purple-500';
    public const BRIGHT_DELETE_BUTTON_HOVER_COLOR = 'bg-purple-400';

    public const DARK_DELETE_BUTTON_COLOR = 'dark:bg-red-500';
    public const DARK_DELETE_BUTTON_HOVER_COLOR = 'dark:bg-red-400';

    //SUBMIT BUTTON
    public const SUBMIT_BUTTON_COLOR = 'bg-green-600';
    public const SUBMIT_BUTTON_HOVER_COLOR = 'bg-green-500';
    //////////////////////////////////////////////////////////////////////////


    ///////////////////////////TABLE STYLES////////////////////////////////
    //TABLE BACKGROUND COLORS
    public const BRIGHT_TABLE_BG_COLOR = 'bg-gray-50';
    public const DARK_TABLE_BG_COLOR = 'dark:bg-dark-eval-1';

    //TABLE CAPTION SUBTEXT COLORS
    public const BRIGHT_TABLE_SUBTEXT_COLOR = 'text-gray-500';
    public const DARK_TABLE_SUBTEXT_COLOR = 'dark:text-gray-400';

    //NEW BUTTON STYLES
    public const NEW_BUTTON_BACKGROUND_COLOR = 'bg-green-700';
    public const NEW_BUTTON_BACKGROUND_HOVER_COLOR = 'bg-green-600';

    //TABLE HEADER TEXT COLORS
    public const DARK_TABLE_COLUMN_HEADER_COLOR = 'dark:text-gray-200';
    public const BRIGHT_TABLE_COLUMN_HEADER_COLOR = 'text-gray-100';

    //TABLE HEADER BACKGROUND COLORS
    public const DARK_TABLE_HEADER_BG_COLOR = 'dark:bg-gray-700';
    public const BRIGHT_TABLE_HEADER_BG_COLOR = 'bg-neutral-600';
    //////////////////////////////////////////////////////////////////////////


    ///////////////////////////FORM STYLES////////////////////////////////
    //FORM COLORS
    //FORM BODY COLORS
    public const BRIGHT_FORM_FOREGROUND_COLOR = 'bg-gray-50';
    public const DARK_FORM_FOREGROUND_COLOR = 'dark:bg-dark-eval-1';

    //INPUT BACKGROUND COLORS
    public const BRIGHT_INPUT_BG = 'bg-gray-100';
    public const DARK_INPUT_BG = 'dark:bg-gray-700';
    public const ALERT_INPUT_BG = 'bg-red-100';

    //INPUT BORDER COLORS
    public const BORDER = 'border';
    public const ALERT_BORDER_COLOR = 'border-red-300';
    public const DARK_BORDER_COLOR = 'dark:border-gray-600';
    public const DARK_FOCUS_BORDER = 'dark:focus:border-purple-500';
    public const DARK_FOCUS_RING = 'dark:focus:ring-purple-500';
    public const BRIGHT_BORDER_COLOR = 'border-gray-300';
    public const BRIGHT_FOCUS_RING = 'focus:ring-purple-500';
    public const BRIGHT_FOCUS_BORDER = 'focus:border-purple-500';

    //INPUT LABEL COLORS
    public const ALERT_DARK_TEXT_COLOR = 'text-gray-700';
    public const DARK_PLACEHOLDER_TEXT_COLOR = 'dark:placeholder-gray-400';

    //TOGGLE COLORS
    public const DARK_TOGGLE_UNCHECKED_BG_COLOR = 'dark:bg-gray-700';
    public const BRIGHT_TOGGLE_UNCHECKED_BG_COLOR = 'bg-gray-200';
    public const TOGGLE_CHECKED_COLOR  = 'peer-checked:bg-purple-500';
    //////////////////////////////////////////////////////////////////////////


    ///////////////////////////GENERAL TEXT COLORS////////////////////////////////
    public const DARK_TEXT_COLOR = 'dark:text-white';
    public const BRIGHT_TEXT_COLOR = 'text-gray-900';
    //////////////////////////////////////////////////////////////////////////


    ///////////////////////////FORM INPUT THEME BUILDER////////////////////////////////
    public static function compileFormInputTheme(bool $alert = false) : String
    {
        if($alert)
        {
            $result = self::BORDER . " " .
                self::ALERT_INPUT_BG . " " .
                self::ALERT_DARK_TEXT_COLOR . " " .
                self::ALERT_BORDER_COLOR;
        } else {
            $result = self::BORDER . " " .
                self::DARK_INPUT_BG . " " .
                self::DARK_BORDER_COLOR . " " .
                self::BRIGHT_BORDER_COLOR . " " .
                self::DARK_TEXT_COLOR . " " .
                self::BRIGHT_INPUT_BG;
        }

        return $result . " " .
        self::DARK_PLACEHOLDER_TEXT_COLOR . " " .
        self::DARK_FOCUS_BORDER . " " .
        self::DARK_FOCUS_RING . " " .
        self::BRIGHT_FOCUS_RING . " " .
        self::BRIGHT_FOCUS_BORDER . " " .
        self::BRIGHT_TEXT_COLOR;
    }
    //////////////////////////////////////////////////////////////////////////
}
