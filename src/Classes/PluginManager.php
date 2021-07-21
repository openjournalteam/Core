<?php

namespace OpenJournalTeam\Core\Classes;



class PluginManager
{

  private $plugin;

  public function __construct()
  {
    $this->plugin = app('modules');
  }

  public function all()
  {
    return $this->plugin->all();
  }

  public function getPluginCoreOnly()
  {
    return array_filter($this->plugin->all(), function ($plugin) {
      if (array_key_exists('core', $plugin->json()->getAttributes()) && $plugin->json()->getAttributes()['core'] == true) return true;
    });
  }

  public function getPlugins()
  {
    return array_filter($this->plugin->all(), function ($plugin) {
      if (array_key_exists('core', $plugin->json()->getAttributes()) && $plugin->json()->getAttributes()['core'] == true) return false;
      return true;
    });
  }

  public function find($name)
  {
    return $this->plugin->find($name);
  }

  public function enabled()
  {
    return $this->plugin->enabled();
  }

  public function disabled()
  {
    return $this->plugin->disabled();
  }
}
