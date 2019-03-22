# PIReader (PDF's & Images Reader)
[![Build Status](https://travis-ci.org/kaleu62/pi-reader.svg?branch=master)](https://travis-ci.org/kaleu62/pi-reader)
<a href="https://codeclimate.com/github/codeclimate/codeclimate/maintainability"><img src="https://api.codeclimate.com/v1/badges/a99a88d28ad37a79dbf6/maintainability" /></a>

It's a PDF and Image reader using Smalot\PdfParser and API from https://ocr.space/

### How To Use?

 
    $pireader = new PIReader(
        [
            'apiKey' => 'xxxxxxxxx', // ocr.space API Key
            'production' => false
        ]
    );


Due to the limitation of requests in ocr.space, the 'apiKey' parameter is mandatory, but its apiKey will only be used if the 'production' parameter is set to true.

The application currently consists of some really basic functions:
- Return the OCR parsed Text
- Verify the existence of a text in the document
- Count the number of incidents of a text in the document
- Perform a search in the Text through a regular expression


## getArchive($filePath)

  This function returns an array with text of the parsed contents of the file (Pdf or image) present in the path informed
  
    $pireader->getArchive("http://my_fake_pdf_path/file.pdf");
  
## existsInFile($filePath, $string)

  This function returns a boolean with informing if the text is present in the file of the informed path
  
    $pireader->existsInFile("http://my_fake_pdf_path/file.pdf", "John Doe");

## countOccurrences($filePath, $string)

    $pireader->countOccurrences("http://my_fake_pdf_path/file.pdf", "John Doe");

## regexFind($filePath, $regex)

    $pireader->regexFind("http://my_fake_pdf_path/file.pdf", "[\d{5}\.\d{5} \d{5}\.\d{6} \d{5}\.\d{6} \d{1} \d{14}]");

