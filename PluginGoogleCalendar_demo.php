<?php
class PluginGoogleCalendar_demo{
  function __construct(){
    wfPlugin::includeonce('wf/yml');
    wfPlugin::enable('theme/include');
  }
  public function page_demo(){
    $calendar = wfRequest::get('calendar');
    $data = new PluginWfArray();
    $data->set('calendar', $calendar);
    /**
     * 
     */
    if(!$calendar){
      exit('Param calendar is missing!');
    }
    /**
     * 
     */
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
    $element = wfDocument::getElementFromFolder(__DIR__, __FUNCTION__);
    $element->setByTag($data->get());
    wfDocument::renderElement($element->get());
  }
}
