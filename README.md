# drupal8-sampleprogram

A sample welcome module is created to add text field "Site Api Key" in /admin/config/system/site-information

In order to add this textfield we have created the following files

welcome.services.yml 
RouteSubsciber.php - Where we say that for site information page - load this form 'ExtendedSiteInformationForm'
ExtendedSiteInformationForm.php - We add the field site api key in buildForm() and saving the value in submitForm()
welcome.schema.yml - config variable is created
 
Page is created to return the json format of node for page content type.
