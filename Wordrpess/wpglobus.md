<?php the_widget( 'WPGlobusWidget' ); ?>

### styles
.wpglobus-lang {
  display: flex;
  align-items: center;
}

.wpglobus-lang .list {
  position: relative;
	top: -2px;
}

.wpglobus-selector-link .name,
.wpglobus-selector-link img {
  display: none;
}
.wpglobus-selector-link:visited,
.wpglobus-selector-link {
  font-size: 15px;
  text-decoration: none;
	color: #A0A5C0;
  transition: all .4s;
}
.wpglobus-selector-link:hover {
  color: #00aa00;
}
.wpglobus-selector-link.wpglobus-current-language {
  color: #00aa00;
}


