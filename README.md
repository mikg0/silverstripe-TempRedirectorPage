silverstripe-TempRedirectorPage
===============================

This page type is an extension of the silverstripe-cms RedirectorPage that allows it to choose
the 30X HTTP Status Code that is sent to the client.
By default a 307 Temporary Redirect is sent.

Motivation:
The HTTP status code issued by a RedirectorPage is 301, which means PERMANENT REDIRECT,
and is as such cached indefinitely by some modern browsers or up to the next reboot for others.
A change of target in the RedirectorPage is thus not noticed by visitors until their cache is emptied
manually or their disk is full.

Unfortunately there does not seem to be a solution to fix permanent redirects, once they have been
published. This page is no solution neither for already published 301 redirects, but once you are
aware of the problem you might prefer using a TempRedirectorPage with a 307 or 302 status code
instead of the RedirectorPage.
