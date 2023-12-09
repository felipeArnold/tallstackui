import './globals/globals';
import banner from './components/banner/banner';
import darkTheme from './helpers/dark-theme';
import dialog from './components/dialog/dialog';
import dropdown from './components/dropdown/dropdown';
import loading from './components/loading/loading';
import modal from './components/modal/modal';
import number from './components/form/number';
import select from './components/select/select';
import slide from './components/slide/slide';
import tab from './components/tab/tab';
import textArea from './components/form/textarea';
import toastBase from './components/toast/toast-base';
import toastLoop from './components/toast/toast-loop';
import tooltip from './components/tooltip/tooltip';

document.addEventListener('alpine:init', () => {
  window.Alpine.plugin(tooltip);
  window.Alpine.data('tallstackui_banner', banner);
  window.Alpine.data('tallstackui_darkTheme', darkTheme);
  window.Alpine.data('tallstackui_dialog', dialog);
  window.Alpine.data('tallstackui_dropdown', dropdown);
  window.Alpine.data('tallstackui_loading', loading);
  window.Alpine.data('tallstackui_modal', modal);
  window.Alpine.data('tallstackui_formNumber', number);
  window.Alpine.data('tallstackui_select', select);
  window.Alpine.data('tallstackui_slide', slide);
  window.Alpine.data('tallstackui_tab', tab);
  window.Alpine.data('tallstackui_formTextArea', textArea);
  window.Alpine.data('tallstackui_toastBase', toastBase);
  window.Alpine.data('tallstackui_toastLoop', toastLoop);
});
