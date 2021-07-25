<?php

namespace Biblos\Utils;

function show_alert($action_type, $state)
{
    if ($state === 'ko') {
      echo '<div class="alert alert-danger" role="alert">Ops! C\'è stato un problema, riprova più tardi.</div>';
      return false;
    }

    if ($state === "errore") {
      echo '<div class="alert alert-danger" role="alert"><ul>';
      $error_messages = explode('|', $_GET['messages']);
      foreach ($error_messages as $error) {
          echo "<li>$error</li>";
      }
      echo '</ul></div>';
    }

    if ($action_type === 'cancellazione' && $state === 'ok') {
      echo '<div class="alert alert-success" role="alert">Cancellazione avvenuta con successo</div>';
    } elseif ($action_type === 'modifica' && $state === 'ok') {
      echo '<div class="alert alert-success" role="alert">La modifica è andata a buon fine.</div>';
    } elseif ($action_type === 'inserimento' && $state === 'ok') {
      echo '<div class="alert alert-success" role="alert">Inserimento riuscito con successo.</div>';
    }
}