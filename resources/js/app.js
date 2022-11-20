//import './bootstrap';
import Alpine from 'alpinejs'
import Focus from '@alpinejs/focus'
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import NotificationsAlpinePlugin from '../../vendor/filament/notifications/dist/module.esm'
import AlpineFloatingUI from '@awcodes/alpine-floating-ui'
import Collapse from '@alpinejs/collapse'

Alpine.plugin(Focus)
Alpine.plugin(AlpineFloatingUI)
Alpine.plugin(FormsAlpinePlugin)
Alpine.plugin(NotificationsAlpinePlugin)
Alpine.plugin(Collapse)
 
window.Alpine = Alpine
 
Alpine.start()