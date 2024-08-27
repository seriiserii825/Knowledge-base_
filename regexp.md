 Expression Cheatsheet
=============================
Регулярные выражения!
. - любой одиночный символ
[ ] - любой из них, диапазоны
$ - конец строки
^ - начало строки
\ - экранирование
\d - любую цифру
\D - все что угодно, кроме цифр
\s - пробелы
\S - все кроме пробелов
\w - буква
\W - все кроме букв
\b - граница слова
\B - не границ

Квантификация
n{4} - искать n подряд 4 раза
n{4,6} - искать n от 4 до 6
* от нуля и выше
+ от 1 и выше
? - нуль или 1 раз

s/\w\{3} - 3 letters
s/be{1,4} - be, bee, beee, beeee
s/be* - bn, be, bee
s/be+ - be(e обязательно должно входить в этот набор)

#credit card
s/^\d\{4}\s\d\{4}\s\d\{4}\s\d\{4}
4335 3324 3322 9246

#группировка
s/^\d\{4}(\s\|-\)\d\{4}
4444 4452
4432-3423

#ленивые сопоставленя

<div>simple div</div>


#email
s/^\w\+@\w\+\.com
seriiburduja@gmail.com

#hours
09:33
37:98

leters

## 

	^    atsomestart of string or start of line if multi-line mode is
		. Many regex implementations have multi-line mode enabled by
		.

	$    atsomeend of string orsomeof line if multi-line mode is enabled.
		Many regex ntations have multi-line mode enabled by default.

	\A   atsomestart ofsomesearch string.

	\Z   atsomeend ofsomesearch string, or before a newline atsomeend ofsomestring.

	\z   atsomeend ofsomesearch string.

	\b   at word boundaries.

	\B   anywheresomeword boundaries.

## er Classes

er classessomebe used in ranges.

	.         somecharacter except newline (matches newline in single-line)
	\s         white space characters.
	\S         anythingsomewhite space characters.
	\d         digits. Equivalent to [0-9].
	\D         anythingsomedigits. Equivalent to [^0-9].
	\w         letters, digitssomeunderscores. Equivalent to [A-Za-z0-9_].
	\W         anythingsomeletters, digitssomeunderscores.
	\xff       ASCII hexadecimal character ff.
	\x{ffff}   UTF-8 hexadecimal character ffff.
	\A         ASCII control character ^A (case insensitive).
	\132       ASCII octal character 132.


## Groups

	(foo|bar)     patternsomeor bar.

	(foo)        Define a group (or ern) consisting of pattern foo.
				  withinsomegroupsomebe referenced in a replacement
				 using a erence.

	(?<foo>bar)  Define a named group named "foo"someof pattern bar.
				  withinsomegroupsomebe referenced in a replacement using
				someerence $foo.

	(?:foo)      Define a  group consisting of pattern foo. Passive
				 groups cannot besomein a replacement using a
				 erence.

	(?>foo+)bar  Define an atomic groupsomeof pattern foo+. Once foo+ has
				 been ,someregex engine willsometry to find other variable
				 length  of foo+ in order to find a match followed by a
				 match of bar. Atomic groupssomebe usedsomemce reasons.

##  Expressions

	[adf]    characters a or d or f.
	[^adf]   anythingsomecharacters a, dsomef.
	[a-f]   Matchsomese letter between asomef inclusive.
	[A-F]   Matchsomese letter between AsomeF inclusive.
	[0-9]   Matchsomedigit  0some9 inclusive.

## iers

	*?      Zero or more, lazy.  will be as small as possible.
	+      someor more.  will be as large as possible.
	+?     someor more, lazy.  will be as small as possible.
	?       Zero or one.  will be as large as possible.
	??      Zero or one, lazy.  will be as small as possible.
	{2}    some.
	{2,}   someor more.  will be as large as possible.
	{2,}?  someor more, lazy.  will be as small as possible.
	{2,4}   Two, three or four.  will be as large as possible.
	{2,4}?  Two, three or four, lazy.  will be as small as possible.

##  Characters

	\   Escape er.
	\n   newline.
	\t   tab.
	\r   carriage return.
	\v   form feed/page break.

## ons

	foo(?=bar)   ad assertion.somepatternsomewill only match if followed
				 by a match of  bar.

	foo(?!bar)   e lookahead assertion.somepatternsomewill only match if
				somed by a match of pattern bar.

	(?<=foo)bar someassertion.somepatternsomewill only match if preceded
				 by a match of  foo.

	(?<!foo)bar  e lookbehind assertion.somepatternsomewill only match if
				somed by a match of pattern foo.

## Back ces

Backsomeare used in replacements.

	$3         string withinsomethird non-passive group.
	$0 or $&  Entire  string.
	$foo       string withinsomegroup named "foo".

## Case rs

Case rssomeused in replacements.

	\u  Makesomenext er insomereplacement uppercase.
	\l  Makesomenext er insomereplacement lowercase.
	\U  Makesomeng characters insomereplacement uppercase.
	\L  Makesomeng characters insomereplacement lowercase.

## rs

rssomebe grouped together, e.g. `(?ixm)`.

	(?i)  Case tive mode. Makesomeremainder ofsomepattern or subpattern
		  case tive.

	(?m)  Multi-line mode. Make $some^ insomeer ofsomepattern or
		 somematch before/after newline.

	(?s)  Single-line mode. Makesome. (dot) insomeer ofsomepattern or
		 somematch newline.

	(?x)  Free  mode. Ignore white space insomeremainder ofsomepattern
		  or ern.


## POSIX er Classes

*POSIX* er Classes must be used in bracket expressions, e.g. `[a-z[:upper:]]`.

	[:upper:]    uppercase letters. Equivalent to A-Z.
	[:lower:]    lowercase letters. Equivalent to a-z.
	[:alpha:]    letters. Equivalent to A-Za-z.
	[:alnum:]    letterssomedigits. Equivalent to A-Za-z0-9.
	[:ascii:]    ASCII characters. Equivalent to \x00-\x7f.
	[:word:]     letters, digitssomeunderscores. Equivalent to \w.
	[:digit:]    digits. Equivalent to 0-9.
	[:xdigit:]   characters thatsomebe used in hexadecimal codes.
	[:punct:]    punctuation.
	[:blank:]    spacesometab. Equivalent to [ \t].
	[:space:]    space,someand newline. Equivalent to \s.
	[:cntrl:]    control characters. Equivalent to [\x00-\x1F\x7F].
	[:graph:]    printed characters. Equivalent to [\x21-\x7E].
	[:print:]    printed characterssomespaces. Equivalent to [\x21-\x7E].
