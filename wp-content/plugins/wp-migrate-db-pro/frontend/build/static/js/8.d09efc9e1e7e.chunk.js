(this.webpackJSONPwpmdb=this.webpackJSONPwpmdb||[]).push([[8],{831:function(e,t,n){"use strict";n.r(t);var a=n(2),i=n(0),c=n.n(i),l=n(1),r=n(7),s=n(62),o=n(12),u=n(134),p=n.n(u),d=n(11),m=n.n(d),b=n(44),f=n(20),g=n.n(f),h=Object(r.c)(function(e){return{theme_plugin_files:e.theme_plugin_files,panel_info:e.panels,local_version:e.migrations.local_site.theme_plugin_files_version}},{})(function(e){var t="",n=e.theme_plugin_files,a=e.panelsOpen,i=e.selected,r=e.items,s=e.type;if(!g()(a,s)&&(n[s]||{}).enabled){if(t=e.summary,["other_files","muplugin_files"].includes(s)){if(0===i.length)return c.a.createElement("span",{className:"empty-warning"},Object(l.a)("Empty selection","wp-migrate-db"));var o=[];r.forEach(function(e){i.includes(e.path)&&o.push(e.name)}),t=o.join(", ")}"core_files"===s&&(t=Object(l.a)("Export all Core files","wp-migrate-db"))}return c.a.createElement(c.a.Fragment,null,m()(t))}),_=n(681),O=n(103),v=n(317),j=n(140),E=function(e){var t=e.ariaLabel,n=e.optionChoices,a=e.type,i=e.value,l=Object(r.d)(),s=n,o=function(t){l(e.updateOption(t.target.value,a))},u=Object.keys(s).map(function(e){var t=a+"-"+e,n=i===e;return c.a.createElement("div",{key:e},c.a.createElement("input",{id:t,type:"radio",value:e,checked:n,onChange:o,name:a}),c.a.createElement("label",{htmlFor:t},m()(s[e])))});return c.a.createElement("div",{className:"radiogroup",role:"radiogroup","aria-label":t},u)},w=n(104),y=n(16),x=n(5),P=n(309),S=function(e,t,n){var a=[];if("object"===typeof t){var i=Object.values(t).map(function(e){return e[0].path});"selected"===n["".concat(e,"_option")]&&n["".concat(e,"_selected")].forEach(function(e){i.includes(e)&&a.push(e)}),"except"===n["".concat(e,"_option")]&&n["".concat(e,"_excluded")].forEach(function(e){i.includes(e)&&a.push(e)}),"active"===n["".concat(e,"_option")]&&Object.values(t).forEach(function(e){e[0].active&&a.push(e[0].path)}),"all"===n["".concat(e,"_option")]&&(a=i)}return a};var k=function(e,t){var n=e.theme_plugin_files,a=e.panelsOpen,u=e.current_migration,d=e.remote_site,f=e.local_site,g=u.status,k=u.intent,C=Object(v.b)(e),N=Object(r.d)(),F=t.title,L=t.type,T=t.panel_name,I=t.items,W=function(){return"savefile"===k?I:I.filter(function(e){return!1===e.path.includes("wp-migrate-db")})},M=I.map(function(e){return e.path}),U=!1,D={push:"Push",pull:"Pull",savefile:"Export"},J={all:Object(l.c)(Object(l.a)("%s all %s","wp-migrate-db"),D[k],L),active:Object(l.c)(Object(l.a)("%s only active %s","wp-migrate-db"),D[k],L),selected:Object(l.c)(Object(l.a)("%s only selected %s","wp-migrate-db"),D[k],L),except:Object(l.c)(Object(l.a)("%s all %s <b>except</b> those selected","wp-migrate-db"),D[k],L)},V=function(e,t,n,a,i){var c=i.site_details,l=S(a,c[a],e),r={themes:"theme_files",plugins:"plugin_files",muplugins:"muplugin_files",others:"other_files",core:"core_files"},s=(e[r[a]]||{}).enabled;return{enabled:void 0!==s&&s,isOpen:t.includes(r[a]),selected:l,selectionEmpty:p()(n,{name:"SELECTED_".concat(a.toUpperCase(),"_EMPTY")})}}(n,a,g,L,"pull"===k?d:f),A=V.enabled,Y=V.isOpen,q=V.selected,z=V.selectionEmpty;Object(i.useEffect)(function(){"select"===n["".concat(L,"_option")]&&N(e.updateSelected(q,L)),"except"===n["".concat(L,"_option")]&&e.updateExcluded(q,L)},[]),A&&!Y&&(U=!0);var B=[],G="selected"===n["".concat(L,"_option")]||"except"===n["".concat(L,"_option")];U&&B.push("has-divider"),A&&B.push("enabled");var H={muplugins:Object(l.a)("Select any must-use plugins to be included in the migration.","wp-migrate-db"),others:Object(l.a)("Select any other files and folders found in the <code>wp-content</code> directory to be included in the migration.","wp-migrate-db"),core:Object(l.a)("Including WordPress core files ensures that the exported archive contains the exact version of WordPress installed on this site, which is helpful when replicating the site in a new environment. ","wp-migrate-db")},K=Object(x.j)(T,u,f,d);return c.a.createElement(b.a,{title:F,className:B.join(" "),panelName:T,disabled:C,writable:K,enabled:A,forceDivider:U,callback:function(t){return Object(j.c)(t,T,Y,A,C,e.addOpenPanel,e.removeOpenPanel,function(){return N(Object(s.g)(T))})},toggle:Object(s.g)(T),hasInput:!0,bodyClass:"tpf-panel-body",panelSummary:c.a.createElement(h,Object(o.a)({},e,{disabled:C,items:W(),selected:q,title:F,type:T,summary:J[n["".concat(L,"_option")]]}))},c.a.createElement("div",null,["others","muplugins","core"].includes(L)&&c.a.createElement("p",{className:"panel-instructions"},m()(H[L]),"core"===L&&c.a.createElement(P.a,{link:"https://deliciousbrains.com/wp-migrate-db-pro/doc/full-site-exports/",content:Object(l.a)("Learn When to Include Core Files","wp-migrate-db"),utmContent:"wordpress-core-files-panel",utmCampaign:"wp-migrate-documentation",hasArrow:!0,anchorLink:"wordpress-core-files"})),!["others","muplugins","core"].includes(L)&&c.a.createElement(E,{ariaLabel:Object(l.c)(Object(l.a)("%s options","wp-migrate-db"),L),optionChoices:J,intent:"push",type:L,value:n["".concat(L,"_option")],updateOption:s.m}),"core"!==L&&c.a.createElement(w.a,{id:"".concat(L,"-multiselect"),options:W(),extraLabels:"",stateManager:function(t){"except"===n["".concat(L,"_option")]&&e.updateExcluded(t,L),e.updateSelected(t,L)},selected:q,visible:!0,disabled:!G,updateSelected:function(t){var a=t.map(function(e){return e.path});"except"===n["".concat(L,"_option")]?e.updateExcluded(a,L):e.updateSelected(a,L)},selectInverse:function(){return"except"===n["".concat(L,"_option")]?Object(O.a)(e.updateExcluded,M,q,L):Object(O.a)(e.updateSelected,M,q,L)},showOptions:G,type:L,themePluginOption:n["".concat(L,"_option")]})),"core"!==L&&c.a.createElement("div",{className:"excludes-wrap"},c.a.createElement(_.a,Object(o.a)({},e,{excludes:n["".concat(L,"_excludes")],excludesUpdater:e.updateExcludes,type:L}))),z&&"selected"===n["".concat(L,"_option")]&&c.a.createElement(y.a,{type:"danger"},Object(l.c)(Object(l.a)("Please select at least one %s for migration","wp-migrate-db"),{themes:"theme",plugins:"plugin",muplugins:"must-use plugin",others:"file or directory",core:"file or directory"}[L])),z&&"except"===n["".concat(L,"_option")]&&c.a.createElement(y.a,{type:"danger"},Object(l.c)(Object(l.a)("Please select at least one %s to exclude from migration","wp-migrate-db"),"themes"===L?"theme":"plugin")))},C=n(4),N=(n(635),n(35)),F=n(22);function L(e,t){var n={};return["themes","plugins","muplugins","others","core"].forEach(function(i,c){var l="pull"===t?e.remote_site.site_details[i]:e.local_site.site_details[i],r="pull"===t||"savefile"===t?e.local_site.site_details[i]:e.remote_site.site_details[i],s=l,o=[],u=function(e){if(r){var t=r[e];if(t&&t[0].hasOwnProperty("version"))return t[0].version}return null};for(var p in s){var d=s[p];if(d){var m={name:d[0].name,path:d[0].path};["plugins","themes"].includes(i)&&"savefile"!==t&&(m=Object(a.a)(Object(a.a)({},m),{},{active:d[0].active,sourceVersion:d[0].version,destinationVersion:u(p)})),o.push(m)}}return n[i]=o}),n}var T=function(e){var t=L(e,e.current_migration.intent).themes;return k(e,{title:Object(l.a)("Themes","wp-migrate-db"),type:"themes",panel_name:"theme_files",items:t})},I=function(e){var t=L(e,e.current_migration.intent).plugins;return k(e,{title:Object(l.a)("Plugins","wp-migrate-db"),type:"plugins",panel_name:"plugin_files",items:t})},W=function(e){var t=L(e,e.current_migration.intent).muplugins;return 0===t.length?null:k(e,{title:Object(l.a)("Must-Use Plugins","wp-migrate-db"),type:"muplugins",panel_name:"muplugin_files",items:t})},M=function(e){var t=L(e,e.current_migration.intent).others;return 0===t.length?null:k(e,{title:Object(l.a)("Other Files","wp-migrate-db"),type:"others",panel_name:"other_files",items:t})},U=function(e){var t=e.current_migration.intent,n=L(e,t).core;return"savefile"!==t||0===n.length?null:k(e,{title:Object(l.a)("WordPress Core Files","wp-migrate-db"),type:"core",panel_name:"core_files",items:n})};t.default=Object(r.c)(function(e){var t=Object(C.f)("current_migration",e),n=Object(C.f)("local_site",e),a=Object(C.f)("remote_site",e),i=Object(N.a)("panelsOpen",e),c=Object(C.d)("stages",e),l=Object(C.g)("status",e);return{theme_plugin_files:e.theme_plugin_files,current_migration:t,local_site:n,remote_site:a,panelsOpen:i,stages:c,status:l}},{toggleThemePluginFiles:s.g,updateTPFOption:s.m,updateSelected:s.l,updateExcluded:s.j,togglePanelsOpen:F.l,addOpenPanel:F.c,removeOpenPanel:F.h,updateExcludes:s.k,kickOffTPFStage:s.d})(function(e){return c.a.createElement("div",{className:"theme-plugin-files"},c.a.createElement(T,e),c.a.createElement(I,e),c.a.createElement(W,e),c.a.createElement(M,e),c.a.createElement(U,e))})}}]);