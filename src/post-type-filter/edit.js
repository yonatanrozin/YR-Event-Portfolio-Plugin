import { __ } from '@wordpress/i18n';
import { useBlockProps, InnerBlocks, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { useEntityRecords } from '@wordpress/core-data';

export default function Edit({ attributes, setAttributes }) {

	const postTypes = useEntityRecords('root', 'postType', {per_page: -1})?.records?.filter(type => type.viewable);

	function onPostTypeSelected(postType) {
		setAttributes({postType})
	}

	return <>
		<div {...useBlockProps()}>
			<InspectorControls >
				<PanelBody title='Post Type'>
					<SelectControl onChange={onPostTypeSelected} value={attributes.postType}>
						{postTypes?.map(type => <option key={type.slug} value={type.slug}>
							{type.name}
						</option>)}
					</SelectControl>
				</PanelBody>
			</InspectorControls>
			<InnerBlocks />
		</div >
	</>
}
