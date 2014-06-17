<?php namespace Expstudio\FriendlyUrl;

use \Patchwork\PHP\Shim\Normalizer as n;

class NonLatinSlugger {
/**
	 * Transliterate a UTF-8 value to ASCII.
	 *
	 * @param  string  $value
	 * @return string
	 */
	public static function ascii($value)
	{
		return static::toAscii($value);
	}

	/**
	 * Generate a URL friendly "slug" from a given string.
	 *
	 * @param  string  $title
	 * @param  string  $separator
	 * @return string
	 */
	public static function slug($title, $separator = '-')
	{
		$title = static::ascii($title);

		// Convert all dashes/undescores into separator
		$flip = $separator == '-' ? '_' : '-';

		$title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

		// Remove all characters that are not the separator, letters, numbers, or whitespace.
		$title = preg_replace('![^'.preg_quote($separator).'ก-๙\pL\pN\s]+!u', '', mb_strtolower($title));
    
		// Replace all separator characters and whitespace by a single separator
		$title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

		return trim($title, $separator);
	}


  // Generic UTF-8 to ASCII transliteration

  static function toAscii($s, $subst_chr = '?')
  {
      if (preg_match("/[\x80-\xFF]/", $s))
      {
          static $translitExtra = array();
          $translitExtra or $translitExtra = static::getData('translit_extra');

          $s = n::normalize($s, n::NFKC);

/**/        $glibc = 'glibc' === ICONV_IMPL;

          preg_match_all('/./u', $s, $s);

          foreach ($s[0] as &$c)
          {
              if (! isset($c[1])) continue;

/**/            if ($glibc)
/**/            {
                  $t = iconv('UTF-8', 'utf-8//TRANSLIT', $c);
/**/            }
/**/            else
/**/            {
                  $t = iconv('UTF-8', 'utf-8//IGNORE//TRANSLIT', $c);

                  if (! isset($t[0])) $t = '?';
                  else if (isset($t[1])) $t = ltrim($t, '\'`"^~');
/**/            }

              if ('?' === $t)
              {
                  if (isset($translitExtra[$c]))
                  {
                      $t = $translitExtra[$c];
                  }
                  else
                  {
                      $t = n::normalize($c, n::NFD);

                      if ($t[0] < "\x80") $t = $t[0];
                      else $t = $subst_chr;
                  }
              }

              $c = $t;
          }

          $s = implode('', $s[0]);
      }

      return $s;
  }

  protected static function getData($file)
  {
      $file = __DIR__ . '/Utf8/data/' . $file . '.ser';
      if (file_exists($file)) return unserialize(file_get_contents($file));
      else return false;
  }

}