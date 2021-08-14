<aside id="secondary" class="widget-area" role="complementary">
        <?php
        $pages = get_pages();
        foreach ($pages as $page) {
            $option = '<option value="' . get_page_link($page->ID) . '">';
            $option .= $page->post_title;
            $option .= '</option>';

            echo $option;
        }
        ?>
    </select>
</aside>
