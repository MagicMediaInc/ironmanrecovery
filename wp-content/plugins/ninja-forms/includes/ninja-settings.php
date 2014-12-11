<?php

function nf_get_settings(){
  $settings = apply_filters( "ninja_forms_settings", get_option( "ninja_forms_settings" ) );

  $settings['date_format'] = isset ( $settings['date_format'] ) ? $settings['date_format'] : 'd/m/Y';
  $settings['currency_symbol'] = isset ( $settings['currency_symbol'] ) ? $settings['currency_symbol'] : '$';
  $settings['req_div_label'] = isset ( $settings['req_div_label'] ) ? $settings['req_div_label'] : __( 'Os campos marcados com * são obrigatórios', 'ninja-forms' );
  $settings['req_field_symbol'] = isset ( $settings['req_field_symbol'] ) ? $settings['req_field_symbol'] : '<strong>*</strong>';
  $settings['req_error_label'] = isset ( $settings['req_error_label'] ) ? $settings['req_error_label'] : __( 'Por favor, garantir que todos os campos obrigatórios estão concluídas.', 'ninja-forms' );
  $settings['req_field_error'] = isset ( $settings['req_field_error'] ) ? $settings['req_field_error'] : __( 'Este é um campo obrigatório', 'ninja-forms' );
  $settings['spam_error'] = isset ( $settings['spam_error'] ) ? $settings['spam_error'] : __( 'Por favor, responda a questão anti-spam corretamente.', 'ninja-forms' );
  $settings['honeypot_error'] = isset ( $settings['honeypot_error'] ) ? $settings['honeypot_error'] : __( 'Por favor, deixe o campo em branco de spam.', 'ninja-forms' );
  $settings['timed_submit_error'] = isset ( $settings['timed_submit_error'] ) ? $settings['timed_submit_error'] : __( 'Por favor, aguarde para enviar o formulário.', 'ninja-forms' );
  $settings['javascript_error'] = isset ( $settings['javascript_error'] ) ? $settings['javascript_error'] : __( 'Você não pode enviar o formulário sem Javascript habilitado.', 'ninja-forms' );
  $settings['invalid_email'] = isset ( $settings['invalid_email'] ) ? $settings['invalid_email'] : __( 'Por favor insira um endereço de e-mail válido.', 'ninja-forms' );
  $settings['process_label'] = isset ( $settings['process_label'] ) ? $settings['process_label'] : __( 'Processamento', 'ninja-forms' );
  $settings['password_mismatch'] = isset ( $settings['password_mismatch'] ) ? $settings['password_mismatch'] : __( 'As senhas fornecidas não coincidem.', 'ninja-forms' );

  $settings['date_format']           = apply_filters( 'ninja_forms_labels/date_format'           , $settings['date_format'] );
  $settings['currency_symbol']       = apply_filters( 'ninja_forms_labels/currency_symbol'       , $settings['currency_symbol'] );
  $settings['req_div_label']         = apply_filters( 'ninja_forms_labels/req_div_label'         , $settings['req_div_label'] );
  $settings['req_field_symbol']      = apply_filters( 'ninja_forms_labels/req_field_symbol'      , $settings['req_field_symbol'] );
  $settings['req_error_label']       = apply_filters( 'ninja_forms_labels/req_error_label'       , $settings['req_error_label'] );
  $settings['req_field_error']       = apply_filters( 'ninja_forms_labels/req_field_error'       , $settings['req_field_error'] );
  $settings['spam_error']            = apply_filters( 'ninja_forms_labels/spam_error'            , $settings['spam_error'] );
  $settings['honeypot_error']        = apply_filters( 'ninja_forms_labels/honeypot_error'        , $settings['honeypot_error'] );
  $settings['timed_submit_error']    = apply_filters( 'ninja_forms_labels/timed_submit_error'    , $settings['timed_submit_error'] );
  $settings['javascript_error']      = apply_filters( 'ninja_forms_labels/javascript_error'      , $settings['javascript_error'] );
  $settings['invalid_email']         = apply_filters( 'ninja_forms_labels/invalid_email'         , $settings['invalid_email'] );
  $settings['process_label']         = apply_filters( 'ninja_forms_labels/process_label'         , $settings['process_label'] );
  $settings['password_mismatch']     = apply_filters( 'ninja_forms_labels/password_mismatch'     , $settings['password_mismatch'] );

  return $settings;
} // nf_get_settings