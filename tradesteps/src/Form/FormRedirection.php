<?php
namespace Drupal\tradesteps\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

use Symfony\Component\HttpFoundation\RedirectResponse;

class FormRedirection extends FormBase {

    public function buildForm(array $form, FormStateInterface $form_state) {

        $form['actions']['goto_front_page'] = [
            '#type' => 'submit',
            '#value' => $this->t('Goto front page'),
            '#submit' => array([$this, 'onGotoFrontPage']),
        ];

        $form['actions']['gotoFirstNode'] = [
          '#type' => 'submit',
          '#value' => $this->t('Goto first node'),
          '#submit' => array([$this, 'onGotoFirstNode']),
        ];            

        $form['actions']['gotoUserPage'] = [
          '#type' => 'submit',
          '#value' => $this->t('Goto user page'),
          '#submit' => array([$this, 'onGotoUserPage']),
        ];            

        return $form;
    }
    public function onGotoFrontPage(array &$form, FormStateInterface $form_state) {
        $url =  \Drupal\Core\Url::fromRoute('<front>');
        $response = new RedirectResponse($url->toString());
        $response->send();
    }

    public function onGotoFirstNode(array &$form, FormStateInterface $form_state) {
        $nid=1;
        $url =  \Drupal\Core\Url::fromRoute('entity.node.canonical', ['node' => $nid]);
        $response = new RedirectResponse($url->toString());
        $response->send();
    }

    public function onGotoUserPage(array &$form, FormStateInterface $form_state) {
        $url =  \Drupal\Core\Url::fromRoute('user.page');
        $response = new RedirectResponse($url->toString());
        $response->send();
    }


    public function submitForm(array &$form, FormStateInterface $form_state) {
    }
    public function getFormId() {
        return 'tradesteps_form_redirection';
    }
}
