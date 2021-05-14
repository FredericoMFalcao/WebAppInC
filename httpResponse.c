void httpResponse( uint rSz) {

	printf("HTTP/1.1 200 OK\n");
        printf("Date: Mon, 27 Jul 2009 12:28:53 GMT\n");
        printf("Server: Apache/2.2.14 (Win32)\n");
        printf("Last-Modified: Wed, 22 Jul 2009 19:15:56 GMT\n");
        printf("Content-Length: %d\n",rSz);
        printf("Content-Type: text/html\n");
        printf("Connection: Closed\n");
        printf("\n");

}
