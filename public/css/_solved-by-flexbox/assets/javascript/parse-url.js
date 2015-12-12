let a = document.createElement('a');
let cache = {};

/**
 * Parse the given url and return the properties returned
 * by the `Location` object.
 * @param {string} url - The url to parse.
 * @return {Object} An object with the same keys as `window.location`.
 */
export default function(url) {

  if (cache[url]) return cache[url];

  let httpPort = /:80$/;
  let httpsPort = /:443$/;

  a.href = url;

  // Sometimes IE will return no port or just a colon, especially for things
  // like relative port URLs (e.g. "//google.com").
  let protocol = !a.protocol || ':' == a.protocol ?
      location.protocol : a.protocol;

  // Don't include default ports.
  let port = (a.port == '80' || a.port == '443') ? '' : a.port;

  // Sometimes IE incorrectly includes a port (e.g. `:80` or `:443`)  even
  // when no port is specified in the URL.
  // http://bit.ly/1rQNoMg
  let host = a.host.replace(protocol == 'http:' ? httpPort : httpsPort, '');

  // Not all browser support `origin` so we have to build it.
  let origin = a.origin ? a.origin : protocol + '//' + host;

  // Sometimes IE doesn't include the leading slash for pathname.
  // http://bit.ly/1rQNoMg
  let pathname = a.pathname.charAt(0) == '/' ? a.pathname : '/' + a.pathname;

  return cache[url] = {
    hash: a.hash,
    host: host,
    hostname: a.hostname,
    href: a.href,
    origin: origin,
    path: pathname + a.search,
    pathname: pathname,
    port: port,
    protocol: protocol,
    search: a.search
  };
}
