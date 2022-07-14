# `<cms:new>`

Freedom of random values in many languages. This tag is based on amazing work by **@fzaninotto** [^1]

[^1]: See [https://github.com/fzaninotto/Faker](https://github.com/fzaninotto/Faker)&nbsp;

```xml
<cms:new />
```

Complete list of [**modifiers and formatters**](#formatters) will be printed by using tag without parameters as above.

## Formatters

### Address

<details><summary>Address formatters</summary>

```xml
<cms:new 'cityPrefix' />
<cms:new 'secondaryAddress' />
<cms:new 'state' />
<cms:new 'stateAbbr' />
<cms:new 'citySuffix' />
<cms:new 'streetSuffix' />
<cms:new 'buildingNumber' />
<cms:new 'city' />
<cms:new 'streetName' />
<cms:new 'streetAddress' />
<cms:new 'postcode' />
<cms:new 'address' />
<cms:new 'country' />
<cms:new 'latitude' min='-90' max='90' />
<cms:new 'longitude' min='-180' max='180' />
<cms:new 'localCoordinates' />
```
</details>

### Barcode

<details><summary>Barcode formatters</summary>

```xml
<cms:new 'ean13' />
<cms:new 'ean8' />
<cms:new 'isbn10' />
<cms:new 'isbn13' />
```
</details>

### Base

<details><summary>Base formatters</summary>

```xml
<cms:new 'randomDigit' />
<cms:new 'randomDigitNotNull' />
<cms:new 'randomDigitNot' except='5' />
<cms:new 'randomNumber' nbDigits='' strict='' />
<cms:new 'randomFloat' nbMaxDecimals='' min='0' max='' />
<cms:new 'numberBetween' int1='0' int2='2147483647' />
<cms:new 'passthrough' value='' />
<cms:new 'randomLetter' />
<cms:new 'randomAscii' />
<cms:new 'randomElements' array='["a","b","c"]' count='1' allowDuplicates='' />
<cms:new 'randomElement' array='["a","b","c"]' />
<cms:new 'randomKey' array='[]' />
<cms:new 'shuffle' arg='' />
<cms:new 'shuffleArray' array='[]' />
<cms:new 'shuffleString' string='' encoding='UTF-8' />
<cms:new 'numerify' string='###' />
<cms:new 'lexify' string='????' />
<cms:new 'bothify' string='## ??' />
<cms:new 'asciify' string='****' />
<cms:new 'regexify' regex='' />
<cms:new 'toLower' string='' />
<cms:new 'toUpper' string='' />
```
</details>

### Biased

<details><summary>Biased formatters</summary>

```xml
<cms:new 'biasedNumberBetween' min='0' max='100' function='sqrt' />
```
</details>

### Color

<details><summary>Color formatters</summary>

```xml
<cms:new 'hexColor' />
<cms:new 'safeHexColor' />
<cms:new 'rgbColorAsArray' />
<cms:new 'rgbColor' />
<cms:new 'rgbCssColor' />
<cms:new 'rgbaCssColor' />
<cms:new 'safeColorName' />
<cms:new 'colorName' />
<cms:new 'hslColor' />
<cms:new 'hslColorAsArray' />
```
</details>

### Company

<details><summary>Company formatters</summary>

```xml
<cms:new 'catchPhrase' />
<cms:new 'bs' />
<cms:new 'ein' />
<cms:new 'company' />
<cms:new 'companySuffix' />
<cms:new 'jobTitle' />
```
</details>

### DateTime

<details><summary>DateTime formatters</summary>

```xml
<cms:new 'unixTime' max='now' />
<cms:new 'dateTime' max='now' timezone='' />
<cms:new 'dateTimeAD' max='now' timezone='' />
<cms:new 'iso8601' max='now' />
<cms:new 'date' format='Y-m-d' max='now' />
<cms:new 'time' format='H:i:s' max='now' />
<cms:new 'dateTimeBetween' startDate='-30 years' endDate='now' timezone='' />
<cms:new 'dateTimeInInterval' date='-30 years' interval='+5 days' timezone='' />
<cms:new 'dateTimeThisCentury' max='now' timezone='' />
<cms:new 'dateTimeThisDecade' max='now' timezone='' />
<cms:new 'dateTimeThisYear' max='now' timezone='' />
<cms:new 'dateTimeThisMonth' max='now' timezone='' />
<cms:new 'amPm' max='now' />
<cms:new 'dayOfMonth' max='now' />
<cms:new 'dayOfWeek' max='now' />
<cms:new 'month' max='now' />
<cms:new 'monthName' max='now' />
<cms:new 'year' max='now' />
<cms:new 'century' />
<cms:new 'timezone' />
<cms:new 'setDefaultTimezone' timezone='' />
<cms:new 'getDefaultTimezone' />
```
</details>

### File

<details><summary>File formatters</summary>

```xml
<cms:new 'mimeType' />
<cms:new 'fileExtension' />
<cms:test ignore='1'>
<!-- !! Imp.: 'file': Copy a random file from the source directory to the target directory and returns the filename/fullpath -->
<cms:new 'file' sourceDirectory='/tmp' targetDirectory='/tmp' fullPath='1' />
</cms:test>
```
</details>

### HtmlLorem

<details><summary>HtmlLorem formatters</summary>

```xml
<cms:new 'randomHtml' maxDepth='4' maxWidth='4' />
```
</details>

### Image

<details><summary>Image formatters</summary>

```xml
<cms:new 'imageUrl' width='640' height='480' category='' randomize='1' word='' gray='' />
<cms:test ignore='1'>
<!-- !! Imp.: 'image' makes an outside request -->
<cms:new 'image' dir='' width='640' height='480' category='' fullPath='1' randomize='1' word='' gray='' />
</cms:test>
```
</details>

### Internet

<details><summary>Internet formatters</summary>

```xml
<cms:new 'email' />
<cms:new 'safeEmail' />
<cms:new 'freeEmail' />
<cms:new 'companyEmail' />
<cms:new 'freeEmailDomain' />
<cms:new 'safeEmailDomain' />
<cms:new 'userName' />
<cms:new 'password' minLength='6' maxLength='20' />
<cms:new 'domainName' />
<cms:new 'domainWord' />
<cms:new 'tld' />
<cms:new 'url' />
<cms:new 'slug' nbWords='6' variableNbWords='1' />
<cms:new 'ipv4' />
<cms:new 'ipv6' />
<cms:new 'localIpv4' />
<cms:new 'macAddress' />
```
</details>

### Lorem

<details><summary>Lorem formatters</summary>

```xml
<cms:new 'word' />
<cms:new 'words' nb='3' asText='' />
<cms:new 'sentence' nbWords='6' variableNbWords='1' />
<cms:new 'sentences' nb='3' asText='' />
<cms:new 'paragraph' nbSentences='3' variableNbSentences='1' />
<cms:new 'paragraphs' nb='3' asText='' />
<cms:new 'text' maxNbChars='200' />
```
</details>

### Miscellaneous

<details><summary>Miscellaneous formatters</summary>

```xml
<cms:new 'boolean' chanceOfGettingTrue='50' />
<cms:new 'md5' />
<cms:new 'sha1' />
<cms:new 'sha256' />
<cms:new 'locale' />
<cms:new 'countryCode' />
<cms:new 'countryISOAlpha3' />
<cms:new 'languageCode' />
<cms:new 'currencyCode' />
<cms:new 'emoji' />
```
</details>

### Payment

<details><summary>Payment formatters</summary>

```xml
<cms:new 'bankAccountNumber' />
<cms:new 'bankRoutingNumber' />
<cms:new 'creditCardType' />
<cms:new 'creditCardNumber' type='' formatted='' separator='-' />
<cms:new 'creditCardExpirationDate' valid='1' />
<cms:new 'creditCardExpirationDateString' valid='1' expirationDateFormat='' />
<cms:new 'creditCardDetails' valid='1' />
<cms:new 'iban' countryCode='' prefix='' length='' />
<cms:new 'swiftBicNumber' />
```
</details>

### Person

<details><summary>Person formatters</summary>

```xml
<cms:new 'suffix' />
<cms:new 'ssn' />
<cms:new 'name' gender='' />
<cms:new 'firstName' gender='' />
<cms:new 'firstNameMale' />
<cms:new 'firstNameFemale' />
<cms:new 'lastName' />
<cms:new 'title' gender='' />
<cms:new 'titleMale' />
<cms:new 'titleFemale' />
```
</details>

### PhoneNumber

<details><summary>PhoneNumber formatters</summary>

```xml
<cms:new 'tollFreeAreaCode' />
<cms:new 'tollFreePhoneNumber' />
<cms:new 'areaCode' />
<cms:new 'exchangeCode' />
<cms:new 'phoneNumber' />
<cms:new 'e164PhoneNumber' />
<cms:new 'imei' />
```
</details>

### Text

<details><summary>Text formatters</summary>

```xml
<cms:new 'realText' maxNbChars='200' indexSize='2' />
```
</details>

### UserAgent

<details><summary>UserAgent formatters</summary>

```xml
<cms:new 'macProcessor' />
<cms:new 'linuxProcessor' />
<cms:new 'userAgent' />
<cms:new 'chrome' />
<cms:new 'firefox' />
<cms:new 'safari' />
<cms:new 'opera' />
<cms:new 'internetExplorer' />
<cms:new 'windowsPlatformToken' />
<cms:new 'macPlatformToken' />
<cms:new 'linuxPlatformToken' />
```
</details>

## Usage

Tag parameters can be of various types. Addon takes care of matching types to expected ones.

+ parameters of `boolean` type can be written as you like — ***1, 0, false, true, yes, no***

   ```xml
   <cms:new 'randomElements' array='["a", "b", "C"]' count='2' allowDuplicates='yes' />
   <cms:new 'randomNumber' nbDigits='5' strict='true' />
   <cms:new 'slug' nbWords='6' variableNbWords='1' />
   ```
+ provider (formatter) names can be camelCase or lower case

   ```xml
   <cms:new 'safeEmail' />
   <cms:new 'firstNameMale' />
   <cms:new 'firstnamefemale' />
   ```

+ named parameters can be placed in any order

   ```xml
   <cms:new 'dateTime' timezone='GMT' max='tomorrow' />
   ```

+ parameters can have no names at all, but in such case must be in the same expected order as in reference

   ```xml
   <cms:new 'randomElements' my_array '2' 'yes'/>
   <cms:new 'dateTime' 'tomorrow' 'GMT' />
   ```

+ validator functions are CouchCMS anonymous functions, with the parameter **_into**

   Reserved variable name is ***new_value***, it will be passed from tag internally to validator.

   Function must return either ***1 (yes, true)*** or ***0 (no, false)***.

   ```xml
   <cms:func _into='evenValidator'>
       <cms:if "<cms:mod new_value '2' />">0<cms:else />1</cms:if>
   </cms:func>
   <ol>
   <cms:set my_arr = '["1", "3", "2", "4", "9"]' is_json='1' />
   <cms:repeat '10'>
       <li><cms:new 'randomElement' array=my_arr validator=evenValidator /></li>
   </cms:repeat>
   </ol>
   ```

+ locale can be set in tag and if omitted the deafult locale will be used: ***en_US***

   ```xml
   <cms:new 'city' locale='ru_RU' />
   <cms:new 'city' />
   ```

## Installation

Everything described in the dedicated [**INSTALL**](/INSTALL.md) page applies.

## Support

See dedicated [**SUPPORT**](/SUPPORT.md) page.

