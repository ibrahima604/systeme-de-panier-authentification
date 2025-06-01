--
-- PostgreSQL database dump
--

-- Dumped from database version 16.8
-- Dumped by pg_dump version 16.8

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: article_couleur_images; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.article_couleur_images (
    id bigint NOT NULL,
    article_id bigint NOT NULL,
    couleur_id bigint NOT NULL,
    image character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.article_couleur_images OWNER TO postgres;

--
-- Name: article_couleur_images_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.article_couleur_images_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.article_couleur_images_id_seq OWNER TO postgres;

--
-- Name: article_couleur_images_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.article_couleur_images_id_seq OWNED BY public.article_couleur_images.id;


--
-- Name: articles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.articles (
    id bigint NOT NULL,
    libelle character varying(255) NOT NULL,
    prix numeric(8,2) NOT NULL,
    description text NOT NULL,
    quantite integer NOT NULL,
    image character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.articles OWNER TO postgres;

--
-- Name: articles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.articles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.articles_id_seq OWNER TO postgres;

--
-- Name: articles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.articles_id_seq OWNED BY public.articles.id;


--
-- Name: couleurs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.couleurs (
    id bigint NOT NULL,
    nom character varying(255) NOT NULL,
    code_hex character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.couleurs OWNER TO postgres;

--
-- Name: couleurs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.couleurs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.couleurs_id_seq OWNER TO postgres;

--
-- Name: couleurs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.couleurs_id_seq OWNED BY public.couleurs.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    nom character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.personal_access_tokens_id_seq OWNER TO postgres;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: tailles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tailles (
    id bigint NOT NULL,
    nom character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.tailles OWNER TO postgres;

--
-- Name: tailles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tailles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tailles_id_seq OWNER TO postgres;

--
-- Name: tailles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tailles_id_seq OWNED BY public.tailles.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    nom character varying(255) NOT NULL,
    prenom character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    tel character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    sexe character varying(255),
    deleted_at timestamp(0) without time zone,
    CONSTRAINT users_sexe_check CHECK (((sexe)::text = ANY ((ARRAY['M'::character varying, 'F'::character varying])::text[])))
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: variantes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.variantes (
    id bigint NOT NULL,
    article_id bigint NOT NULL,
    couleur_id bigint NOT NULL,
    taille_id bigint NOT NULL,
    quantite integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.variantes OWNER TO postgres;

--
-- Name: variantes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.variantes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.variantes_id_seq OWNER TO postgres;

--
-- Name: variantes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.variantes_id_seq OWNED BY public.variantes.id;


--
-- Name: article_couleur_images id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article_couleur_images ALTER COLUMN id SET DEFAULT nextval('public.article_couleur_images_id_seq'::regclass);


--
-- Name: articles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.articles ALTER COLUMN id SET DEFAULT nextval('public.articles_id_seq'::regclass);


--
-- Name: couleurs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.couleurs ALTER COLUMN id SET DEFAULT nextval('public.couleurs_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: tailles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tailles ALTER COLUMN id SET DEFAULT nextval('public.tailles_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: variantes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.variantes ALTER COLUMN id SET DEFAULT nextval('public.variantes_id_seq'::regclass);


--
-- Data for Name: article_couleur_images; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.article_couleur_images (id, article_id, couleur_id, image, created_at, updated_at) FROM stdin;
2	12	2	article_couleur_images/ypjFQaaVcwQiVMPQYNp89nQgKMxXx012sYq7OYEE.png	2025-05-24 14:03:11	2025-05-24 14:03:11
3	12	1	article_couleur_images/DIcn7FYLD09JCywTEtWDoaldnWyM9TM2upYzRYlJ.jpg	2025-05-24 14:10:37	2025-05-24 14:10:37
4	10	1	article_couleur_images/a3p8zbbZ7eRjeH5GEO0rpQdyNOtiRELohr4g9vAu.jpg	2025-05-24 16:43:28	2025-05-24 16:43:28
\.


--
-- Data for Name: articles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.articles (id, libelle, prix, description, quantite, image, created_at, updated_at, deleted_at) FROM stdin;
3	Short	200.07	Officia ut ut fugit et sint necessitatibus natus doloremque. Iste quisquam ut sed vitae. Earum consequatur consequatur reiciendis velit nostrum dolores. Perspiciatis dolore quia voluptate incidunt.	70	https://source.unsplash.com/600x800/?shorts,clothing,aqua,fashion,apparel&sig=69287	2025-03-02 11:44:09	2025-05-22 15:13:28	\N
1	Shirt natus black	147.38	Doloribus dolor dolorem ratione in. Eaque commodi et iste. Fugiat quia placeat consequatur et. Accusantium totam qui corrupti nam aut.	20	https://source.unsplash.com/600x800/?shirt,clothing,black,fashion,apparel&sig=25027	2024-11-09 16:32:11	2025-05-22 15:13:41	\N
12	Un t-shirt en coton	150.00	Découvrez notre t-shirt en coton classique, un incontournable de votre garde-robe. Fabriqué à partir de coton de haute qualité, ce t-shirt allie confort et style pour un look intemporel.\r\n\r\nCaractéristiques :\r\n\r\nMatière : 100% coton pour une douceur et une respirabilité optimales.\r\nCoupe : Coupe classique, idéale pour un ajustement confortable et décontracté.\r\nDesign : Col rond et manches courtes pour un style polyvalent.\r\nEntretien : Lavable en machine à 30°C, séchage à plat recommandé pour préserver la qualité du tissu.	10	articles/SxOAIR5ODrPSZdO2sZY8IBcDb10jEKBgcY3y1S4R.png	2025-05-23 16:00:15	2025-05-23 16:00:15	\N
4	Skirt suscipit olive	199.04	Iure voluptas rerum dolor ex tempore repellendus sequi iure. Culpa totam non sequi modi. Accusantium numquam eveniet adipisci corrupti harum est ex. Quia sint explicabo hic facere omnis accusantium molestiae.	18	https://source.unsplash.com/600x800/?skirt,clothing,olive,fashion,apparel&sig=47696	2025-01-03 23:33:21	2025-05-19 15:18:41	\N
11	Tshirt natus purple	145.80	Aut delectus rerum perspiciatis sed doloremque eligendi non. Consectetur voluptatem accusamus nostrum et ea et. Sint et minus quis saepe.	29	image_83359.jpg	2024-06-01 07:04:38	2025-05-23 16:43:45	\N
13	hhh	170.00	jhjjjjjjjjjjjjjjjjj	3	articles/HNbFKrH48pgLDxq5QV5MNVwpKzqwyiLGrA41wHwi.png	2025-05-23 21:21:26	2025-05-24 14:02:48	2025-05-24 14:02:48
5	Hoodie quaerat	133.58	Veritatis voluptatem est velit aspernatur est qui dolorem. Voluptatum reiciendis provident corrupti omnis modi. Fugiat explicabo excepturi voluptatem aut. Qui ut doloribus quae ea esse omnis.	30	C:\\Users\\PC\\AppData\\Local\\Temp\\phpF359.tmp	2024-08-18 17:17:09	2025-05-20 11:31:12	\N
10	T-shirt d’Été en Coton Bio – Ultra Respirant	120.00	Ce t-shirt d’été, confectionné en coton biologique doux et respirant, est l’allié idéal pour affronter les journées chaudes avec style et confort. Grâce à sa coupe moderne et légère, il offre une grande liberté de mouvement tout en gardant une allure soignée.	20	articles/17MF19nwUVGHNUfzKZYkDSEpqMmiBYJmZNiUgeKf.jpg	2025-05-20 12:31:48	2025-05-22 11:06:16	\N
2	Jacket	199.80	Labore nesciunt et rerum voluptatem culpa. Et est dolores in quia. Recusandae nihil maxime sint non iure sit id.	10	articles/0Vcn1ZP2427saUctTGDmpkGYJVoltRQlLaAII5sn.jpg	2024-12-12 17:46:25	2025-05-22 11:06:23	\N
6	Shorts fugit green	176.53	Sed nesciunt assumenda eos quod eos soluta iusto. Provident fugit natus asperiores eos corporis labore adipisci ut. Autem reiciendis aliquam aliquam consequuntur provident perferendis molestiae.	6	image_78575.jpg	2024-10-29 16:16:26	2025-05-22 14:04:40	\N
\.


--
-- Data for Name: couleurs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.couleurs (id, nom, code_hex, created_at, updated_at, deleted_at) FROM stdin;
2	Noir	#000000	2025-05-23 15:30:51	2025-05-23 16:39:06	\N
1	Blanc	#FFFFFF	2025-05-23 15:30:51	2025-05-23 18:22:07	\N
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_reset_tokens_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
5	2025_05_05_151926_add_sexe_to_users_table	2
6	2025_05_17_132823_add_is_active_to_users_table	3
7	2025_05_17_152258_add_deleted_at_to_users_table	4
8	2025_05_17_153001_drop_is_active_from_users_table	5
9	2025_05_17_170139_create_articles_table	6
10	2025_05_23_145656_create_couleurs_table	7
11	2025_05_23_145756_create_tailles_table	7
12	2025_05_23_145857_create_variantes_table	7
13	2025_05_24_114205_remove_image_from_couleurs_table	8
14	2025_05_24_114302_create_article_couleur_images_table	8
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, nom, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: tailles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tailles (id, nom, created_at, updated_at, deleted_at) FROM stdin;
1	S	2025-05-23 15:30:51	2025-05-23 15:30:51	\N
2	M	2025-05-23 15:30:51	2025-05-23 15:30:51	\N
3	L	2025-05-23 15:30:51	2025-05-23 15:30:51	\N
4	XL	2025-05-23 15:30:51	2025-05-23 15:30:51	\N
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, nom, prenom, email, email_verified_at, password, tel, remember_token, created_at, updated_at, sexe, deleted_at) FROM stdin;
14	Barry	Oumou	o604@gmail.com	2025-05-12 15:18:11	$2y$12$FukhaHLlIvac.ZASwV62KOQ0wRxlt1zvyCmGzL3zAlRA.hvNJ7pVS	212632684092	VqOKt07vElCbOQc3nWHBApNHsCCbqwTaWkFnJdBFiIpL7gLbaAQFggpPUkxh	2025-05-12 15:15:51	2025-05-22 11:02:33	F	2025-05-22 11:02:33
22	Ibrahima DIALLO		i.diallo0130@uca.ac.ma	2025-05-22 11:12:10	$2y$12$QEj1CFpLRfx99HyRLWTp1ucyEpJysoDVB/yj/IVOW8qTefxlhrer6		\N	2025-05-22 11:11:22	2025-05-22 11:12:10	\N	\N
20	sidibe	Lanc	l604@gmail.com	2025-05-15 12:03:32	$2y$12$lF1CL0vWnc1wZJzFds6W3OBHYQsjY4bZInmXXtB2ZWbUxjmn7XmIK	+212632684099	\N	2025-05-15 12:03:00	2025-05-23 21:19:57	M	\N
17	Diallo	admin	admin@tonsite.com	2025-05-12 16:50:00	$2y$12$E7J0mC7BnJcfLCVY9HsAnuoq3PSDpXreTUlpt2.JzUA51DKN9pt86	224624048819	\N	2025-05-12 16:13:58	2025-05-12 16:50:00	M	\N
11	Ibrahima Diallo		ibd8905@gmail.com	2025-05-07 12:07:01	$2y$12$6nIoh/MJFo9YJu9z875dHe1zW7ML.G7vwcCdMJ257J4D4wt6sJp1y		4dGlmDhVPXm6hImxAfqvxdqWbcsRLvI3p46jBzjblmaHfgE0RqCvoyC44MeY	2025-05-07 12:05:21	2025-05-17 15:52:57	\N	\N
21	Diallo	Mamadou korka	diallomamadoukorka604@gmail.com	2025-05-17 14:50:30	$2y$12$w3PdYE30yyxT/JPWd0Czweedl1.DNn99nFojV.fsSy5O59qHc/0c2		\N	2025-05-15 12:57:58	2025-05-17 16:45:27	\N	\N
\.


--
-- Data for Name: variantes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.variantes (id, article_id, couleur_id, taille_id, quantite, created_at, updated_at) FROM stdin;
25	12	2	1	10	2025-05-24 14:03:11	2025-05-24 14:03:11
26	12	2	2	10	2025-05-24 14:03:11	2025-05-24 14:03:11
27	12	2	3	10	2025-05-24 14:03:11	2025-05-24 14:03:11
28	12	2	4	10	2025-05-24 14:03:11	2025-05-24 14:03:11
29	12	1	1	10	2025-05-24 14:10:37	2025-05-24 14:10:37
30	12	1	2	10	2025-05-24 14:10:37	2025-05-24 14:10:37
31	12	1	3	10	2025-05-24 14:10:37	2025-05-24 14:10:37
32	12	1	4	10	2025-05-24 14:10:37	2025-05-24 14:10:37
33	10	1	1	10	2025-05-24 16:43:28	2025-05-24 16:43:28
34	10	1	2	10	2025-05-24 16:43:28	2025-05-24 16:43:28
\.


--
-- Name: article_couleur_images_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.article_couleur_images_id_seq', 4, true);


--
-- Name: articles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.articles_id_seq', 13, true);


--
-- Name: couleurs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.couleurs_id_seq', 2, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 14, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: tailles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tailles_id_seq', 4, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 22, true);


--
-- Name: variantes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.variantes_id_seq', 34, true);


--
-- Name: article_couleur_images article_couleur_images_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article_couleur_images
    ADD CONSTRAINT article_couleur_images_pkey PRIMARY KEY (id);


--
-- Name: articles articles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.articles
    ADD CONSTRAINT articles_pkey PRIMARY KEY (id);


--
-- Name: couleurs couleurs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.couleurs
    ADD CONSTRAINT couleurs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: tailles tailles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tailles
    ADD CONSTRAINT tailles_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: variantes variantes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.variantes
    ADD CONSTRAINT variantes_pkey PRIMARY KEY (id);


--
-- Name: articles_libelle_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX articles_libelle_index ON public.articles USING btree (libelle);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: article_couleur_images article_couleur_images_article_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article_couleur_images
    ADD CONSTRAINT article_couleur_images_article_id_foreign FOREIGN KEY (article_id) REFERENCES public.articles(id) ON DELETE CASCADE;


--
-- Name: article_couleur_images article_couleur_images_couleur_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.article_couleur_images
    ADD CONSTRAINT article_couleur_images_couleur_id_foreign FOREIGN KEY (couleur_id) REFERENCES public.couleurs(id) ON DELETE CASCADE;


--
-- Name: variantes variantes_article_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.variantes
    ADD CONSTRAINT variantes_article_id_foreign FOREIGN KEY (article_id) REFERENCES public.articles(id) ON DELETE CASCADE;


--
-- Name: variantes variantes_couleur_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.variantes
    ADD CONSTRAINT variantes_couleur_id_foreign FOREIGN KEY (couleur_id) REFERENCES public.couleurs(id) ON DELETE CASCADE;


--
-- Name: variantes variantes_taille_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.variantes
    ADD CONSTRAINT variantes_taille_id_foreign FOREIGN KEY (taille_id) REFERENCES public.tailles(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

