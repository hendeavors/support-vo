<?php

/**
* SyntacticallyValidEmail.php
*
* @author: Adam Rodriguez
*
* Copyright (c) 2013-2017 Adam Rodriguez
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
*
* Credit: Jeffrey Stedfast <jestedfa@microsoft.com>
* This is a direct translation of Jeffrey Stedfast's EmailValidator.cs
* https://github.com/tbitowner/EmailValidation/blob/master/EmailValidation/EmailValidator.cs
**/

namespace Endeavors\Support\VO\Validators;

use Endeavors\Support\VO\Exceptions;
use Endeavors\Support\VO\ModernString;

class SyntacticallyValidEmail
{
    const AtomCharacters = "!#$%&'*+-/=?^_`{|}~";
    const Alphabetic = 1;
    const Numeric = 2;
    const None = 0;

    protected $type;

    public function validate($value)
    {
        if( false === $this->validatationResult($value) ) {
            throw new Exceptions\InvalidEmail(sprintf("Value %s is not a valid email address", $value));
        }

        return true;
    }

    protected function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    protected function getType()
    {
        return $this->type;
    }

    protected function isDigit($c)
    {
        return ($c >= '0' && $c <= '9');
    }

    protected function isHexDigit($c)
    {
        return ($c >= 'A' && $c <= 'F') || ($c >= 'a' && $c <= 'f') || ($c >= '0' && $c <= '9');
    }

    protected function isLetter($c)
    {
        return ($c >= 'A' && $c <= 'Z') || ($c >= 'a' && $c <= 'z');
    }

    protected function isLetterOrDigit($c)
    {
        return $this->isLetter ($c) || $this->isDigit ($c);
    }

    protected function isAtom($c)
    {
        return ord($c) < 128 ? $this->isLetterOrDigit ($c) || ModernString::create(self::AtomCharacters)->contains($c) : false;
    }

    protected function isDomain($c, &$type)
    {
        if (ord($c) < 128) {
            if ($this->isLetter ($c) || $c == '-') {
                $type = $type ?: self::Alphabetic;
                return true;
            }

            if ($this->isDigit ($c)) {
                $type = $type ?: self::Numeric;
                return true;
            }

            return false;
        }

        return false;
    }

    protected function isDomainStart($c, &$type)
    {
        if (ord($c) < 128) {
            if ($this->isLetter ($c)) {
                $type = self::Alphabetic;
                return true;
            }

            if ($this->isDigit ($c)) {
                $type = self::Numeric;
                return true;
            }

            $type = self::None;

            return false;
        }

        $type = self::None;

        return false;
    }

    protected function skipAtom($text, &$index)
    {
        $startIndex = (int)$index;

        $text = ModernString::create($text);

		while ($index < $text->length() && $this->isAtom ($text->get()[$index])) {
            $index++;
        }

		return $index > $startIndex;
    }

    protected function skipSubDomain($text, &$index, &$type)
    {
        $startIndex = (int)$index;

        $text = ModernString::create($text);

		if ( ! $this->isDomainStart($text->get()[$index], $type) )
			return false;

		$index++;

		while ($index < $text->length() && $this->isDomain ($text->get()[$index], $type))
			$index++;

		return ($index - $startIndex) < 64 && $text->get()[$index - 1] != '-';
    }

    protected function skipDomain($text, &$index, $allowTopLevelDomains = true)
    {
        $type = null;

        $text = ModernString::create($text);

		if ( ! $this->skipSubDomain ($text->get(), $index, $type))
			return false;

		if ($index < $text->length() && $text->get()[$index] == '.') {
			do {
				$index++;

				if ($index == $text->length())
					return false;

				if ( ! $this->skipSubDomain ($text->get(), $index, $type))
                    return false;
                    
			} while ($index < $text->length() && $text->get()[$index] == '.');
		} else if ( ! $allowTopLevelDomains ) {
			return false;
		}

		// Note: by allowing AlphaNumeric, we get away with not having to support punycode.
		if ($type == self::Numeric)
			return false;

		return true;
    }

    protected function skipQuoted($text, &$index)
    {
        $text = ModernString::create($text);

        $escaped = false;

		// skip over leading '"'
		$index++;

		while ($index < $text->length()) {
            if (ord($text->get()[$index]) >= 128)
				return false;

			if ($text->get()[$index] == '\\') {
				$escaped = !$escaped;
			} else if (!$escaped) {
				if ($text->get()[$index] == '"')
					break;
			} else {
				$escaped = false;
			}

			$index++;
        }
        
		if ($index >= $text->length() || $text->get()[$index] != '"')
			return false;

        $index++;

		return true;
    }

    protected function skipIPv4Literal ($text, &$index)
    {
        $groups = 0;
        $text = ModernString::create($text);

        while ($index < $text->length && $groups < 4) {
            $startIndex = $index;
            $value = 0;

            while ($index < $text->length && $text->get()[$index] >= '0' && $text->get()[$index] <= '9') {
                $value = ($value * 10) + ($text->get()[$index] - '0');
                $index++;
            }

            if ($index == $startIndex || $index - $startIndex > 3 || $value > 255)
                return false;

            $groups++;

            if ($groups < 4 && $index < $text->length && $text->get()[$index] == '.')
                $index++;
        }

        return $groups == 4;
    }


    protected function skipIPv6Literal ($text, &$index)
    {
        $compact = false;
        $colons = 0;
        $text = ModernString::create($text);

        while ($index < $text->length) {
            $startIndex = $index;

            while ($index < $text->length && $this->isHexDigit ($text->get()[$index]))
                $index++;

            if ($index >= $text->length)
                break;

            if ($index > $startIndex && $colons > 2 && $text->get()[$index] == '.') {
                // IPv6v4
                $index = $startIndex;

                if (!$this->skipIPv4Literal ($text, $index))
                    return false;

                return $compact ? $colons < 6 : $colons == 6;
            }

            $count = $index - $startIndex;
            if ($count > 4)
                return false;

            if ($text->get()[$index] != ':')
                break;

            $startIndex = $index;
            while ($index < $text->length && $text->get()[$index] == ':')
                $index++;

            $count = $index - $startIndex;
            if ($count > 2)
                return false;

            if ($count == 2) {
                if ($compact)
                    return false;

                $compact = true;
                $colons += 2;
            } else {
                $colons++;
            }
        }

        if ($colons < 2)
            return false;

        return $compact ? $colons < 7 : $colons == 7;
    }

    protected function validatationResult ($email, $allowTopLevelDomains = true)
    {
        $index = 0;

        $email = ModernString::create($email);

        if($email->isEmpty())
            return false;
                    
        if ($email->length() >= 255)
            return false;
        
        // Local-part = Dot-string / Quoted-string
        //       ; MAY be case-sensitive
        //
        // Dot-string = Atom *("." Atom)
        //
        // Quoted-string = DQUOTE *qcontent DQUOTE

        if ($email->get()[$index] == '"') {
            if ( ! $this->skipQuoted ($email->get(), $index) || $index >= $email->length())
                return false;
        } else {
                
            if ( ! $this->skipAtom ($email, $index) || $index >= $email->length() ) {
                return false;
            }
        
            while ($email->get()[$index] == '.') {
                $index++;
        
                if ($index >= $email->length())
                    return false;
        
                if (!$this->skipAtom ($email, $index))
                    return false;
        
                if ($index >= $email->length())
                    return false;
            }
        }
        
        if ($index + 1 >= $email->length() || $index > 64 || $email->get()[$index++] != '@')
            return false;  
        
        if ($email->get()[$index] != '[') {
            // domain
            if (!$this->skipDomain ($email->get(), $index, $allowTopLevelDomains))
                return false;

            return $index == $email->length;
        }
        
        // address literal
        $index++;
        // we need at least 8 more characters
		if ($index + 8 >= $email->length)
            return false;

        $ipv6 = $email->substring ($index, 5);
        if ($ipv6->toLower()->get() == "ipv6:") {
            $index += mb_strlen("IPv6:");
            if (!$this->skipIPv6Literal ($email, $index))
                return false;
        } else {
            if (!$this->skipIPv4Literal ($email, $index))
                return false;
        }

        if ($index >= $email->length || $email->get()[$index++] != ']')
            return false;

        return $index == $email->length;     
    }
}