// import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.scss'

import 'tw-elements'

// TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com 
// Initialization for ES Users
import {
    Collapse,
    Dropdown,
    initTE,
  } from "tw-elements";
  
  initTE({ Collapse, Dropdown });

import {
    Datatable,
    Input,
    Ripple,
  } from "tw-elements";
  
  initTE({ Datatable, Input, Ripple });

  

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉')
