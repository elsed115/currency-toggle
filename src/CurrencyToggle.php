<?php

namespace Elsed115\CurrencyToggle;

use Laravel\Nova\Fields\Field;

class CurrencyToggle extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'currency-toggle';

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        // Recupera il codice valuta dal file di configurazione di Nova
        $currencyCode = config('nova.currency', 'EUR');
        // Ottieni il simbolo corrispondente usando il NumberFormatter
        $currencySymbol = $this->getCurrencySymbol($currencyCode);

        $this->withMeta([
            'currency' => $currencySymbol,
        ]);
    }
    
    /**
     * Restituisce il simbolo della valuta basato sul codice ISO 4217.
     *
     * Utilizza l'estensione Intl per formattare la valuta e poi estrae il simbolo.
     *
     * @param string $currencyCode
     * @return string
     */
    protected function getCurrencySymbol($currencyCode)
    {
        // Prendi il locale dell'app, o usa un default
        $locale = config('app.locale', 'en_US');
        
        // Crea un formatter per la valuta
        $formatter = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
        
        // Format una cifra (0) con il codice della valuta
        $formatted = $formatter->formatCurrency(0, $currencyCode);
        
        // Il risultato potrebbe essere ad esempio "€0.00" oppure "0,00 €"
        // Rimuovi numeri, virgole, punti e spazi per ottenere solo il simbolo
        $symbol = preg_replace('/[\d\s\.,-]/', '', $formatted);
        
        return $symbol ?: $currencyCode;
    }
}
