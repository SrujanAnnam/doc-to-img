# doc-to-img

## Required Softwares
1. Imagemagick
2. GraphicsMagick
3. Ghostscript
4. Libreoffice
5. Composer

## composer install
To install the required packages via Composer, follow these steps:

Install Composer:
If you haven't installed Composer yet, you can download and install it following the instructions on the official Composer website: https://getcomposer.org/download/

Create a composer.json file:
In your project's root directory, create a file named composer.json if you don't already have one.

Add Symfony HttpFoundation to composer.json:
Open the composer.json file and add the following code to it:

{
    "require": {
        "symfony/http-foundation": "^5.0"
    }
}

The symfony/http-foundation package contains the Symfony HttpFoundation component, which is needed to handle file uploads and other HTTP-related tasks in PHP.

Run Composer to install the dependencies:
Open a terminal or command prompt in your project's root directory and run the following command:

composer install

Composer will read the composer.json file, fetch the required packages from the packagist repository, and install them into the vendor directory within your project.

Include the Composer autoloader in your PHP files:
In any PHP file where you want to use the Symfony HttpFoundation component, you need to include the Composer-generated autoloader. Add the following line at the beginning of your PHP files:

require_once 'vendor/autoload.php';

That's it! Now you have Symfony HttpFoundation installed in your project, and you can use it to handle file uploads and other HTTP-related tasks in your PHP code.

//////////////////////////////////////////////////

composer require symfony/http-foundation


## libreoffice install
To set the path for LibreOffice in the Windows environment variables, follow these steps:

Locate the Installation Path: First, make sure you know the installation path of LibreOffice on your system. The default installation path is typically "C:\Program Files\LibreOffice\program" or "C:\Program Files (x86)\LibreOffice\program" for 64-bit and 32-bit versions, respectively.

Open Environment Variables Settings:

Press Win + S on your keyboard to open the Windows Search.
Type "Environment Variables" and select the "Edit the system environment variables" option from the results.
Environment Variables Dialog:

In the "System Properties" dialog that appears, click the "Environment Variables" button at the bottom.
Edit System Variables:

In the "Environment Variables" dialog, you'll see two sections: "User variables" (applies to the current user) and "System variables" (applies to all users on the system).
Under the "System variables" section, scroll down and find the "Path" variable. Select it and click the "Edit" button.
Add LibreOffice Path:

In the "Edit Environment Variable" dialog, click the "New" button.
Enter the path to the "program" folder of LibreOffice (e.g., "C:\Program Files\LibreOffice\program") and click "OK".
Apply Changes:

Click "OK" on all open dialogs to apply the changes.
Verify the Path:

Open a new Command Prompt (or PowerShell) window, or you may need to restart any already-opened Command Prompt or PowerShell windows.
Type soffice and press Enter. This should launch LibreOffice if the path is set correctly.
That's it! Now LibreOffice should be accessible from any Command Prompt or PowerShell window on your system. Note that you may need administrative privileges to modify system environment variables.
