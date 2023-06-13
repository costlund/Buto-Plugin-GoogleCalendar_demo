# Buto-Plugin-GoogleCalendar_demo
Handle date from a Google Calendar using plugin google/calendar.

## Webmaster page
Shows all availible methods.
Edit param calendar an run this url.

- http://localhost/?webmaster_plugin=google/calendar_demo&page=demo&calendar=__url__to__basic.ics__

## Code
````
wfPlugin::includeonce('google/calendar');
$google = new PluginGoogleCalendar(true);
$google->filename = $calendar;
$google->init();
if($google->failure){
  exit("Could not fetch data from url $calendar!");
}
$data->set('getAllTimeEvents', sfYaml::dump( $google->getAllTimeEvents()));
$data->set('getAllDayEvents', sfYaml::dump( $google->getAllDayEvents()));
$data->set('getCalendar', sfYaml::dump( $google->getCalendar()));
$data->set('getMinutesPerDay', sfYaml::dump( $google->getMinutesPerDay()));
$data->set('getMinutesPerMonth', sfYaml::dump( $google->getMinutesPerMonth()));
$data->set('getMinutesPerWeek', sfYaml::dump( $google->getMinutesPerWeek()));
$data->set('getMinutesPerWeekAndDay', sfYaml::dump( $google->getMinutesPerWeekAndDay(), 99));
$data->set('getCompleteDateArray', sfYaml::dump( $google->getCompleteDateArray($google->getMinutesPerDay()), 99));
$data->set('getStartAndEndDate', sfYaml::dump( $google->getStartAndEndDate(date('W'), date('Y')), 99));
````
