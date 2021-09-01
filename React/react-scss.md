npm i node-sass@4.14.1


import React from 'react';
import Link from "next/link";
import { ReactSVG } from "react-svg";
import { useRouter } from "next/router";
import { useImmer } from "use-immer";
import cnBind from "classnames/bind";
import styles from "./navigation-admin.module.scss";

const cx = cnBind.bind(styles);

function NavigationAdmin() {
  const router = useRouter();
  const [innerMenu, setInnerMenu] = useImmer({ pageMenu: false });

  function togglePageInner() {
    setInnerMenu(draft => {
      draft.pageMenu = !draft.pageMenu
    });
  }

  return (
    <div className={styles.navigation}>
      <ul className={styles.list}>
        <li className={styles.item}>
          <span className={styles.itemInner}>
            <ReactSVG className={styles.icon} src="/svg/home-20.svg"/>
            <Link className={styles.link} href="/">Home</Link>
          </span>
        </li>
        <li className={styles.item}>
          <span
            className={cx(styles.itemInner, { active: router.pathname === '/admin/page' })}
          >
            <ReactSVG className={styles.icon} src="/svg/page-15.svg"/>
            <Link className={styles.link} href="/admin/page">Page</Link>
            <span className={styles.toggle} onClick={togglePageInner}>
              {innerMenu.pageMenu ? <ReactSVG src="/svg/toggle-on-25.svg"/> : <ReactSVG src="/svg/toggle-off-25.svg"/>}
            </span>
          </span>
          {innerMenu.pageMenu && (
            <ul>
              <li>
              <span
                className={cx(styles.itemInner, { active: router.pathname === '/admin/page/new' })}>
                <ReactSVG className={styles.icon} src="/svg/add-15.svg"/>
                <Link className={styles.link} href="/admin/page/new">New</Link>
              </span>
              </li>
            </ul>
          )}
        </li>
      </ul>
    </div>
  );
}

export default NavigationAdmin;
