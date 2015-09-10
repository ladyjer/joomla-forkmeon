Forkmeon
=========
A Joomla! ```3``` Module usefull to publish a list of public GIT repositories of a particular user.
##Programming language
PHP
##Runtime platform
Joomla! 3 Module
##Supported Web-based Git repository hosting service
Forkmeon supports GitHub.
To support others, such as BitBucket, it needs to implement related versions of /mod_forkmeon/helpers/gitrepo.php and /mod_forkmeon/helpers/gitrepos.php files.
##Layout
Forkmeon comes with two kind of layout: default and microdata
### Default
An old fashioned plain ```<ul><li>``` HTML list, with repository name, description and direct link to GIT hosting service opening in a new window.
### Microdata
Still a list of repositories, with the addition of microdata from [SoftwareSourceCode](http://schema.org/SoftwareSourceCode "SoftwareSourceCode") schema.
Item properties injected are:
* [name](http://schema.org/name "Name")
* [about](http://schema.org/about "Name")
* [codeRepository](http://schema.org/codeRepository "codeRepository")
* [author](http://schema.org/author "author") using [person](http://schema.org/Person "person") with name (GIT hosting username), url (GIT hosting user home) and image (GIT hosting avatar)
These item properties are taken from README.md file:
* [programmingLanguage](http://schema.org/programmingLanguage "programmingLanguage")
* [runtimePlatform](http://schema.org/runtimePlatform "runtimePlatform")
##Module Class Suffix
Try 'zigzag'!
