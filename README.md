#Nonce-sense
Using PHP and the mcrypt library to make single-use, time limited tokens that also ensure a web form originated on your site

##What is this?
This is code from the Portland Maine Web Developers Meetup group presentation I gave on June 13, 2016, titled "Nonce-sense"

It describes the creation and use of cryptographic nonces with a timestamp and a GUID, to ensure timely and once-only submission of a form, using PHP and the mcrypt library.

Slides for this presentation are at https://docs.google.com/presentation/d/1WAmYUs_NBJD_Ft1-kb43LstRgzIe6MdJlS_dYvgkD_k/edit?usp=sharing

##Files
**guid.txt** This is a simple text file where I store an incremental counter for the GUID.Note that you should never, ever, EVER have writeable files in your public HTTP paths. This is for demo purposes only; always place writable files outside of your public HTTP paths, or you're likely to have you sites defaced.

**include.php** These are the background functions that create my cryptographic nonces and validate them, as well as my means of issuing and retrieving GUIDs that ensure once-only processing of a form.

**index.php** This file contains the form which also has a nonce that's specific to my site, time-restricted to one minute, and contains a GUID to ensure once-only processing.

**nononce.php** The same file as index.php, but this one doesn't create a nonce, so that it fails to correctly process.

**process.php** The file that handles our form postback, receives the nonce, sees if it is valid, then checks the GUID to see if it's in order / has been used.
