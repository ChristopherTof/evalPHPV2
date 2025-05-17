<?php

class ViewFooter
{

    public function displayView(): string
    {
        ob_start()
?>
        </main>
        <footer>
            Je suis le Footer
        </footer>
        </body>

        </html>
<?php

        return ob_get_clean();
    }
}
