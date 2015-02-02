<?php

namespace repositories;

interface AperoMailerInterface{
    function send($view, $data);
}