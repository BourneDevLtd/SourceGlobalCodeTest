<?php

namespace Drupal\employeemanagement\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

/**
 * Class EmployeesList.
 */
class EmployeesList extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'employees_list';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $table_headers = [
      'id' => t('ID'),
      'name' => t('Name'),
      'department' => t('Department'),
      'reporting_to' => t('Manager'),
    ];

    $table_employees = Database::getConnection()->select('employees', 'e')
       ->fields('e', array('id', 'name', 'department', 'reporting_to'))
       ->execute()
       ->fetchAll(\PDO::FETCH_ASSOC);
  
    $form['employees_table'] = [
      '#type' => 'table',
      '#title' => $this->t('Employees List'),
      '#header' => $table_headers,
      '#rows' => $table_employees,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) { }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) { }

}
