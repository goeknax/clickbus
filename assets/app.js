/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';
import axios from "axios";

// assets/js/app.js
import { createApp } from 'vue'

import Example from './components/Example'
import History from './components/History'
/**
* Create a fresh Vue Application instance
*/
createApp({
    components: { Example, History }
}).mount('#app')