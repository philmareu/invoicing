# Invoicing

Years ago, I was tracking customers, projects and invoices in seperate services. When project work was completed, I would transfer customer and project information into the invoicing service and send an invoice.

In an effort to streamline this process, I decided to build my own service that could consolidate these processes. I based the project on 3 core resources which are customers, work orders (work) and invoices. These resources are fully dependent. Work could not be created without an invoice and an invoice could not be created without a customer.

This dependancy makes delivering invoices painless, since the are updated in real time.
