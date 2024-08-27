 <div class="language">
   <?php if (!dynamic_sidebar('sidebar-1')) : ?>
     <h2>lsdkjflkdsf</h2>
   <?php endif; ?>
   <div class="language__btn">
     <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
       <g clip-path="url(#clip0_1015_1148)">
         <path d="M9.75 4.5L6 8.25L2.25 4.5" stroke="#363636" stroke-linecap="round" stroke-linejoin="round" />
       </g>
       <defs>
         <clipPath id="clip0_1015_1148">
           <rect width="12" height="12" fill="white" />
         </clipPath>
       </defs>
     </svg>

   </div>
</div>

   <style lang="scss">
     .language {
       position: relative;
       margin-right: 8rem;

       &__btn {
         position: absolute;
         top: 1.9rem;
         right: 0;
       }
     }

     .widget_wpglobus {
       &.active {
         .wpglobus-selector-link {
           &:nth-of-type(2) {
             opacity: 1;
             transform: translateY(0);
           }
         }
       }

       .widget-title {
         display: none;
       }

       .list a span.code {
         display: none;
       }

       .wpglobus-selector-link {
         display: flex !important;
         align-items: center;
         padding: 1.6rem;
         color: #363636;
         font-size: 20px;
         font-weight: 500;

         //&:first-of-type {
         //  pointer-events: none;
         //}

         &:nth-of-type(2) {
           position: absolute;
           top: 5rem;
           left: 0;
           background: #FFFFFF;
           opacity: 0;
           transition: all .5s;
           transform: translateY(50%);

         }
       }

       .list.flags img {
         margin-bottom: 0;
         border-radius: 3px;
         width: 3.3rem;
         margin-right: 0.8rem;
       }

     }
   </style>
 </div>
 <script>
   export default function wpGlobus() {
     const first_elem = document.querySelector('.wpglobus-selector-link:first-of-type');
     console.log(first_elem)
     const widget_wpglobus = document.querySelector('.widget_wpglobus');

     const last_elem = document.querySelector('.wpglobus-selector-link:last-of-type');
     first_elem.addEventListener("click", function(e) {

       e.preventDefault()
       console.log(last_elem)
       widget_wpglobus.classList.toggle("active")
     })
   }
 </script>
