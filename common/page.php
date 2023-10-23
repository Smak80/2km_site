<?php

namespace common;

require_once ("a_content.php");
require_once ("json_loader.php");

class page
{
    private a_content $content;
    private array $pages;
    private string $pages_file = "data/pages.json";

    public function __construct(a_content $content){
        $this->content = $content;
        $this->pages = json_loader::get_full_info($this->pages_file);
        $this->create_headers();
        $this->create_body();
        $this->finish_page();
    }

    private function create_headers(): void
    {
        ?>
        <!DOCTYPE HTML>
        <html lang="ru"><head>
            <link rel="stylesheet" type="text/css" href="/css/main.css">
            <link href="/css/bootstrap.min.css" rel="stylesheet">
            <script src="/js/bootstrap.bundle.min.js"></script>
        </head><body>
        <?php
    }

    private function create_body(): void
    {
        $this->create_body_head();
        print ('<div class="row">');
        print ('<div class="col-2 alert alert-danger">');
        $this->create_menu();
        print ('</div>');
        print ('<div class="col-10 alert alert-warning">');
        $this->content->show_content();
        print ('</div>');
        print ('</div>');
        $this->create_footer();
    }

    private function finish_page(): void
    {
        print("</body></html>");
    }

    private function create_body_head(): void
    {
        ?>
        <div class="container">
            <div class="row w-100">
                <div class="col-12">
                    <div class="header">НАЗВАНИЕ СТРАНИЦЫ</div>
                </div>
            </div>
        </div>
        <?php
    }

    private function create_menu(): void
    {
        print ('<div class="container w-100 p-0">');
        foreach ($this->pages as $page){
            print ('<div class="row border border-danger w-100 p-0 m-0">');
            $pi = $this->get_current_page_info();
            print ('<div class="col-12 border border-black text-center p-2">');
            if (strcmp($pi['uri'], $page['uri']) === 0){
                print "<div class='d-inline fw-bold'>{$page['name']}</div>";
            } else {
                print ("<a href='{$page['uri']}'>{$page['name']}</a>");
            }
            print ('</div>');
            print ('</div>');
        }
        print ('</div>');
    }

    private function create_footer(): void
    {
        print ('<div class="row">');
        print ('<div class="col-12 alert alert-primary text-end">© Сергей Маклецов, 2023.</div>');
        print ('</div>');
    }

    private function get_current_page_info(): array | null
    {
        $file = preg_replace('/\\?.*/', '', basename($_SERVER['REQUEST_URI']));
        foreach ($this->pages as $page){
            if (strcmp($file, $page['uri']) === 0 || isset($page['alias']) && strcmp($file, $page['alias']) === 0){
                return $page;
            }
        }
        return null;
    }

}