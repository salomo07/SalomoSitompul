<aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header"></li>
        <?php foreach ($daftarmenu as $key => $menu): ?>
          <li class="treeview">
            <?php echo $menu->IconMenu; ?>
            <?php $CI =& get_instance();$daftarmenu2=$CI->m_login->getSubMenuAside($menu->IdRole,$menu->IdMenu); if (count($daftarmenu2>0)): ?>
              <ul class="treeview-menu">
              <?php foreach ($daftarmenu2 as $key => $menu2): ?>
                  <li><?php echo $menu2->IconMenu2; ?></li>
                <?php endforeach ?>
              </ul>
            <?php endif ?>
          </li>
        <?php endforeach ?>
      </ul>
    </section>
  </aside>