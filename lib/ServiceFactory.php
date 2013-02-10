<?php


class xautoload_ServiceFactory {

  /**
   * Registration plan.
   *
   * @return object
   *   Object that will register Drupal-related namespaces and prefixes at
   *   applicable moments during the request.
   */
  function plan($services) {
    if (version_compare(PHP_VERSION, '5.3') >= 0) {
      return new xautoload_DrupalRegistrationPlan_PHP53($services->classFinder);
    }
    else {
      return new xautoload_DrupalRegistrationPlan_PHP52($services->classFinder);
    }
  }

  /**
   * Loaders
   *
   * @return object
   *   Object that can create class loaders with different cache mechanics,
   *   register the one for the currently configured cache method, and also
   *   switch between cache methods.
   */
  function loaders($services) {
    return new xautoload_ClassLoaders($services->finder);
  }

  /**
   * Legacy alias for 'finder'.
   *
   * @return xautoload_ClassFinder_Interface
   *   Object that can find classes.
   *   Note: The findClass() method takes an InjectedAPI argument.
   */
  function classFinder($services) {
    return $services->finder;
  }

  /**
   * @return xautoload_ClassFinder_Interface
   *   Object that can find classes.
   *   Note: The findClass() method takes an InjectedAPI argument.
   */
  function finder($services) {

    if (version_compare(PHP_VERSION, '5.3') >= 0) {
      // Create the finder with namespace support.
      return new xautoload_ClassFinder_NamespaceOrPrefix();
    }
    else {
      // If we are not at PHP 5.3 +, we can't have namespaces support.
      return new xautoload_ClassFinder_Prefix();
    }
  }
}
